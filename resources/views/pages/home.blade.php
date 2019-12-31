@extends('layouts.master')

@section('title','Home Page')

@section('css')
    <style>
        /**
        * Make flexbox grids super easy!
        * ---
        * @param $cols  —  Number of columns
        * @param $margin  —  Margin with unit
        */
        .container{
            width: 100%;
            padding-top: 37px;
            margin-top: 25px;
        }
        @media screen and (min-width: 600px) and (max-width: 799px) {
            .flexgrid .container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }
            .flexgrid .container:after {
                flex: auto;
                margin: 0 auto;
                content: "";
            }
            .flexgrid .container > * {
                width: calc( 50% - 0.5rem );
                margin-left: 0.5rem;
                margin-right: 0.5rem;
            }
            .flexgrid .container > *:nth-child(1) {
                margin-left: 0;
            }
            .flexgrid .container > *:nth-child(2n) {
                margin-right: 0;
            }
            .flexgrid .container > *:nth-child(2n + 1) {
                margin-left: 0;
            }
        }
        @media screen and (min-width: 800px) and (max-width: 999px) {
            .flexgrid .container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }
            .flexgrid .container:after {
                flex: auto;
                margin: 0 auto;
                content: "";
            }
            .flexgrid .container > * {
                width: calc( 33.3333333333% - 0.6666666667rem );
                margin-left: 0.5rem;
                margin-right: 0.5rem;
            }
            .flexgrid .container > *:nth-child(1) {
                margin-left: 0;
            }
            .flexgrid .container > *:nth-child(3n) {
                margin-right: 0;
            }
            .flexgrid .container > *:nth-child(3n + 1) {
                margin-left: 0;
            }
        }
        @media screen and (min-width: 1000px) {
            .flexgrid .container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }
            .flexgrid .container:after {
                flex: auto;
                margin: 0 auto;
                content: "";
            }
            .flexgrid .container > * {
                width: calc( 25% - 0.75rem );
                margin-left: 0.5rem;
                margin-right: 0.5rem;
            }
            .flexgrid .container > *:nth-child(1) {
                margin-left: 0;
            }
            .flexgrid .container > *:nth-child(4n) {
                margin-right: 0;
            }
            .flexgrid .container > *:nth-child(4n + 1) {
                margin-left: 0;
            }
        }

        /*
        * Demo Styles
        */
        .flexgrid {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-feature-settings: "liga", "kern";
            font-feature-settings: "liga", "kern";
        }
        .flexgrid *, .flexgrid *:before, .flexgrid *:after {
            box-sizing: border-box;
        }


        .flexgrid .title {
            font-family: 'Baloo Tamma', cursive;
            font-size: 300%;
            padding: 2rem 1rem;
        }
        .flexgrid .thing {
            color: #FEFEFE;
            font-size: 200%;
            padding: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 150px;
            margin-bottom: 1rem;
            cursor: pointer;
            box-shadow: 0 2.5px 5px rgba(25, 25, 25, 0.1);
            background: #1dd2af;
            background: linear-gradient(to bottom, #1dd2af, #17a689);
        }
        .flexgrid .thing:hover {
            -webkit-animation-name: shake;
            animation-name: shake;
            -webkit-animation-duration: 1s;
            animation-duration: 1s;
            -webkit-animation-iteration-count: infinite;
            animation-iteration-count: infinite;
        }
        .flexgrid .thing:nth-child(1), .flexgrid .thing:nth-child(4), .flexgrid .thing:nth-child(7), .flexgrid .thing:nth-child(10) {
            background: #fed26a;
            background: linear-gradient(to bottom, #fed26a, #fec238);
        }
        .flexgrid .thing:nth-child(1):hover, .flexgrid .thing:nth-child(4):hover, .flexgrid .thing:nth-child(7):hover, .flexgrid .thing:nth-child(10):hover {
            -webkit-animation-name: bounce;
            animation-name: bounce;
        }
        .flexgrid .thing:nth-child(2), .flexgrid .thing:nth-child(5), .flexgrid .thing:nth-child(9), .flexgrid .thing:nth-child(14) {
            background: #7ad0ff;
            background: linear-gradient(to bottom, #7ad0ff, #47beff);
        }
        .flexgrid .thing:nth-child(2):hover, .flexgrid .thing:nth-child(5):hover, .flexgrid .thing:nth-child(9):hover, .flexgrid .thing:nth-child(14):hover {
            -webkit-animation-name: swing;
            animation-name: swing;
        }
        .flexgrid .thing:nth-child(3), .flexgrid .thing:nth-child(6), .flexgrid .thing:nth-child(12) {
            background: #df6974;
            background: linear-gradient(to bottom, #df6974, #d73f4e);
        }
        .flexgrid .thing:nth-child(3):hover, .flexgrid .thing:nth-child(6):hover, .flexgrid .thing:nth-child(12):hover {
            -webkit-animation-name: tada;
            animation-name: tada;
        }
        .flexgrid .emoji {
            font-size: 200%;
            -webkit-transform: translateY(20%);
            transform: translateY(20%);
        }
        @-webkit-keyframes bounce {
            from, 20%, 53%, 80%, to {
                -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }
            40%, 43% {
                -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                -webkit-transform: translate3d(0, -30px, 0);
                transform: translate3d(0, -30px, 0);
            }
            70% {
                -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                -webkit-transform: translate3d(0, -15px, 0);
                transform: translate3d(0, -15px, 0);
            }
            90% {
                -webkit-transform: translate3d(0, -4px, 0);
                transform: translate3d(0, -4px, 0);
            }
        }
        @keyframes bounce {
            from, 20%, 53%, 80%, to {
                -webkit-animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }
            40%, 43% {
                -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                -webkit-transform: translate3d(0, -30px, 0);
                transform: translate3d(0, -30px, 0);
            }
            70% {
                -webkit-animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                animation-timing-function: cubic-bezier(0.755, 0.05, 0.855, 0.06);
                -webkit-transform: translate3d(0, -15px, 0);
                transform: translate3d(0, -15px, 0);
            }
            90% {
                -webkit-transform: translate3d(0, -4px, 0);
                transform: translate3d(0, -4px, 0);
            }
        }
        @-webkit-keyframes shake {
            from, to {
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }
            10%, 30%, 50%, 70%, 90% {
                -webkit-transform: translate3d(-10px, 0, 0);
                transform: translate3d(-10px, 0, 0);
            }
            20%, 40%, 60%, 80% {
                -webkit-transform: translate3d(10px, 0, 0);
                transform: translate3d(10px, 0, 0);
            }
        }
        @keyframes shake {
            from, to {
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }
            10%, 30%, 50%, 70%, 90% {
                -webkit-transform: translate3d(-10px, 0, 0);
                transform: translate3d(-10px, 0, 0);
            }
            20%, 40%, 60%, 80% {
                -webkit-transform: translate3d(10px, 0, 0);
                transform: translate3d(10px, 0, 0);
            }
        }
        .flexgrid .shake {
            -webkit-animation-name: shake;
            animation-name: shake;
        }
        @-webkit-keyframes swing {
            20% {
                -webkit-transform: rotate3d(0, 0, 1, 15deg);
                transform: rotate3d(0, 0, 1, 15deg);
            }
            40% {
                -webkit-transform: rotate3d(0, 0, 1, -10deg);
                transform: rotate3d(0, 0, 1, -10deg);
            }
            60% {
                -webkit-transform: rotate3d(0, 0, 1, 5deg);
                transform: rotate3d(0, 0, 1, 5deg);
            }
            80% {
                -webkit-transform: rotate3d(0, 0, 1, -5deg);
                transform: rotate3d(0, 0, 1, -5deg);
            }
            to {
                -webkit-transform: rotate3d(0, 0, 1, 0deg);
                transform: rotate3d(0, 0, 1, 0deg);
            }
        }
        @keyframes swing {
            20% {
                -webkit-transform: rotate3d(0, 0, 1, 15deg);
                transform: rotate3d(0, 0, 1, 15deg);
            }
            40% {
                -webkit-transform: rotate3d(0, 0, 1, -10deg);
                transform: rotate3d(0, 0, 1, -10deg);
            }
            60% {
                -webkit-transform: rotate3d(0, 0, 1, 5deg);
                transform: rotate3d(0, 0, 1, 5deg);
            }
            80% {
                -webkit-transform: rotate3d(0, 0, 1, -5deg);
                transform: rotate3d(0, 0, 1, -5deg);
            }
            to {
                -webkit-transform: rotate3d(0, 0, 1, 0deg);
                transform: rotate3d(0, 0, 1, 0deg);
            }
        }
        @-webkit-keyframes tada {
            from {
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
            }
            10%, 20% {
                -webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
                transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
            }
            30%, 50%, 70%, 90% {
                -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
                transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
            }
            40%, 60%, 80% {
                -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
                transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
            }
            to {
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
            }
        }
        @keyframes tada {
            from {
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
            }
            10%, 20% {
                -webkit-transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
                transform: scale3d(0.9, 0.9, 0.9) rotate3d(0, 0, 1, -3deg);
            }
            30%, 50%, 70%, 90% {
                -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
                transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, 3deg);
            }
            40%, 60%, 80% {
                -webkit-transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
                transform: scale3d(1.1, 1.1, 1.1) rotate3d(0, 0, 1, -3deg);
            }
            to {
                -webkit-transform: scale3d(1, 1, 1);
                transform: scale3d(1, 1, 1);
            }
        }
    </style>
    @endsection

@section('content')
    <div class="flexgrid">
        <div class='container'>
            <div class='thing'>Programs</div>
            <div class='thing'>Flexbox 4evr!</div>
            <div class='thing'><span class="emoji">🙀</span></div>
            <div class='thing'>Easy!</div>
            <div class='thing'><span class="emoji">👍</span></div>
            <div class='thing'>1 of ur 5 a day!<span class="emoji">🍓</span></div>
            <div class='thing'><span class="emoji">🚀</span></div>
            <div class='thing'>Super good!</div>
            <div class='thing'>Gives You Health!<span class="emoji">💕</span></div>
            <div class='thing'><span class="emoji">🔥</span></div>
            <div class='thing'>Delicious!<span class="emoji">🌭</span></div>
            <div class='thing'>Win!!<span class="emoji">🏅</span></div>
            <div class='thing'>Life Changing!</div>
            <div class='thing'>U won't believe wot hapened next...</div>
        </div>
    </div>


@endsection
@section('js')
    <script>
        const flexGrid = ({ columns, margin }) => {
            const width = `${100 / columns}%`;
            const unitlessMargin = margin.match(/[\d?.]/g).join('');
            const unit = margin.match(/[a-zA-Z%]+/g).join('');
            const calcMargin = (unitlessMargin * columns - unitlessMargin) / columns;
            return `
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    &:after {
      flex: auto;
      margin: 0 auto;
      content: "";
    }
    >* {
      width: calc(${width} - ${calcMargin});
      margin-left: ${unitlessMargin / 2}${unit};
      margin-right: ${unitlessMargin / 2}${unit};
      &:nth-child(1) {
        margin-left: 0;
      }
      &:nth-child(${columns}n) {
        margin-right: 0;
      }
      &:nth-child(${columns}n + 1) {
        margin-left: 0;
      }
    }
  `;
        };
    </script>
    @endsection
