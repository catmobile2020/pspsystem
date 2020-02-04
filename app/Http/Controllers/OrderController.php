<?php

namespace App\Http\Controllers;

use App\Batch;
use App\Company;
use App\Helpers\UploadImage;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\PharmacyUsers;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use UploadImage;

    public function company(Company $single)
    {
        return view('pages.order.company',compact('single'));
    }


    public function index(Company $single)
    {
        $user = auth('pharmacyUsers')->user();
        $products = $single->products()->pluck('id')->toArray();
        $rows = $user->orders()->whereIn('product_id',$products)->latest()->paginate(15);
        return view('pages.order.index',compact('rows'));
    }

    public function create(Product $single)
    {
        return view('pages.order.form',compact('single'));
    }

    public function store(Product $product,OrderRequest $request)
    {
        $patient = User::where('serial_number',$request->serial_number)->first();
        if (!$patient)
        {
            return redirect()->back()->with('message','Patient Card Wrong. Try Again!');
        }

        $pack = Batch::where('serial',$request->pack_number)->where('is_free',false)->first();
        if (!$pack)
        {
            return redirect()->back()->with('message','Pack serial number Wrong. Try Again!');
        }
        $product = $patient->callCenter->product;
        $inputs = $request->all();
        $inputs['patient_id']=$patient->id;
        $inputs['batch_id']=$pack->id;
        $inputs['product_id']=$product->id;
        $user = auth('pharmacyUsers')->user();
        $order = $user->orders()->create($inputs);
        if ($order)
        {
            if ($request->photo)
                $this->upload($request->photo,$order);

            $message = "كود العبوة {$request->pack_number}";
            $this->sendSMS($patient->phone,$message);

            $patient->increment('buy');
            $product = $patient->callCenter->product;
            if ($patient->buy == $product->paid_num)
            {
                $patient->update(['buy'=>0]);
                for ($i=0;$i<$product->free_num;$i++)
                {
                    $confirmation_code=rand(000000,999999);
                    $freeOrder = Order::create([
                        'serial_number'=>$patient->serial_number,
                        'comment'=>$product->name,
                        'has_free'=>true,
                        'confirmation_code'=>$confirmation_code,
                        'activated'=>false,
                        'patient_id'=>$patient->id,
                        'product_id'=>$patient->callCenter->product_id

                    ]);
                    if ($freeOrder)
                    {
                        $message = "{$confirmation_code} هذا كود استحقاق العبوة المجانية لبرنامج ايدك فى ايدينا";
                        $this->sendSMS($patient->phone,$message);
                    }
                }
            }
        }
        return redirect()->route('orders.index',$product->company->id)->with('message','Operation Done Successfully');
    }

    public function foc()
    {
        return view('pages.order.foc');
    }

    public function postFoc(OrderRequest $request)
    {
        $user = auth('pharmacyUsers')->user();
        $order = Order::where('serial_number',$request->serial_number)->where('confirmation_code',$request->code)->first();
        if (!$order)
        {
            return redirect()->back()->with('message','Patient Card Or Code  Wrong. Try Again!');
        }
        if ($order->activated)
        {
            return redirect()->back()->with('message','This Code Used Before !');
        }
        $pack = Batch::where('serial',$request->pack_number)->where('is_free',false)->first();
        if (!$pack)
        {
            return redirect()->back()->with('message','Pack serial number Wrong. Try Again!');
        }
        $free_pack = Batch::where('serial',$request->free_serial)->where('is_free',true)->first();
        if (!$free_pack)
        {
            return redirect()->back()->with('message','Free serial number Wrong. Try Again!');
        }
        $order->update([
            'activated'=>true,
            'pharmacy_users_id'=>$user->id,
            'batch_id'=>$pack->id,
            'free_serial'=>$free_pack->serial,
            'confirmation_code'=>null
        ]);
        if ($request->photo)
            $this->upload($request->photo,$order);

        $message = "كود العبوة {$request->pack_number}";
        $this->sendSMS($order->patient->phone,$message);
        return redirect()->route('orders.index',$order->product->company->id)->with('message','Operation Done Successfully');
    }
}
