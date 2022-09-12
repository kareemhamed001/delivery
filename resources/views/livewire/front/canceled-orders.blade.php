<div class="">


    <div class="d-flex flex-column align-items-center m-5 pt-5  ">

        <section
            class=" vw-100 m-0 px-0  min-vh-100 d-flex justify-content-center  bg-white position-relative  ">

            <div class="d-flex flex-column w-100 container-fluid container-md p-1">
                <div class=" d-flex justify-content-center  flex-column  ">
                    <div class="align-self-center">
                        <h3 class="font-monospace font-size-2 font-weight-4 text-center text-uppercase">
                            {{__('myOrdersPage.CanceledOrdersHeader')}}
                        </h3>
                        <p class="text-muted text-center">
                            {{__('myOrdersPage.CanceledOrdersSubheader')}}
                        </p>
                    </div>
                    <div class=" align-self-start col-7 col-sm-6 col-md-5">
                        <input class="form-control d-block col-6 float-end font-size-1 p-2 text-break" type="text"
                               wire:model="term" placeholder="{{__('myOrdersPage.Search')}}">
                    </div>

                </div>
                <div class="my-2 p-0 w-100 d-flex flex-wrap  justify-content-center">

                    @forelse($orders as $order)

                            <?php
                            $now = \Carbon\Carbon::now();

                            $created_at = \Carbon\Carbon::parse($order->delivery_time);
                            $diffHuman = $created_at->diffForHumans($now);
                            $diffHour = $created_at->diffInHours($now);
                            $diffMinutes = $created_at->diffInMinutes($now);

                            $isCurrentHour = $created_at->isCurrentHour();
                            $isCurrentDay = $created_at->isCurrentDay();
                            $isLastHour = $created_at->isLastHour();
                            $isLastMinute = $created_at->isLastMinute();
                            $isPast = $created_at->isPast();

                            ?>

                        <div
                            class="card my-1 col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4  position-relative p-1 font-size-card font-weight-2 border-1 "
                            style="min-height: 500px;max-height: 600px;height: auto">
                            <div
                                class="h-auto col  rounded position-absolute d-flex flex-column justify-content-between align-items-center "
                                style="top: 5px;bottom: 5px; z-index:1;">
                                <i class="fa-solid fa-circle d-block text-orange"></i>
                                <span class="h-100 bg-orange d-block rounded   "
                                      style="width: 2px;"></span>
                                <i class="fa-solid fa-circle d-block text-danger"></i>
                            </div>
                            <div class="card-img mh-25 position-relative p-0 ">

                                <div
                                    class="rounded-end h-auto  w-auto position-absolute mx-2 font-size-card font-weight-2 end-0 bottom-0 p-0">
                                    <div class="list-group m-0  w-100">
                                        <div class="list-group-item col-12 p-1 m-0">
                                            <i class="fa-regular fa-calendar-days"></i> {{__('myOrdersPage.Date')}}:
                                            {{--                                            <span class="">{{date('d/m/Y', strtotime($order->delivery_time)) }} </span>--}}
                                            <span class="">{{$diffHuman }} </span>
                                        </div>
                                        {{--                                        <div class="list-group-item col-12 p-1 m-0">--}}
                                        {{--                                            <i class="fa-regular fa-clock"></i> {{__('myOrdersPage.Time')}}:--}}
                                        {{--                                            <span class="">{{date('h:i a ', strtotime($order->delivery_time)) }}</span>--}}
                                        {{--                                        </div>--}}
                                        <div class="list-group-item col-12 p-1 m-0">
                                            <i class="fa-solid fa-phone"></i> {{__('myOrdersPage.FailureReason')}}
                                            : {{__('myOrdersPage.'.($order->failure_reason))}}
                                        </div>
                                    </div>
                                </div>

                                <svg class="w-100 h-100" style="object-fit: scale-down"
                                     xmlns="http://www.w3.org/2000/svg"
                                     data-name="Layer 1" width="967.97244" height="529" viewBox="80 0 967.97244 529"
                                     xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <path
                                        d="M154.44233,692.271c26.42252,19.03478,60.66413,19.99056,93.76235,17.65213,4.62174-.32609,9.21077-.70874,13.75729-1.12157.02746-.00712.06353-.00458.09143-.01167.2185-.0208.43744-.04161.6465-.054.93841-.08779,1.87724-.1755,2.80685-.26387l-.2196.419-.68925,1.30024c.2477-.43517.49521-.86129.74291-1.29646.07285-.13062.15451-.26067.22693-.39138,8.57426-14.92076,17.07842-30.38965,19.24765-47.4275,2.24221-17.68452-4.05929-37.70924-19.62367-46.40124a31.40808,31.40808,0,0,0-6.4449-2.69923c-.93085-.28285-1.8743-.51228-2.82845-.71534A33.66447,33.66447,0,0,0,216.76908,655.022c-13.19581-13.53109-10.73425-35.482-6.18233-53.82747,4.56073-18.34493,10.08188-38.7585.80579-55.236-5.15643-9.17155-14.2243-14.86189-24.40066-17.15421-.31218-.06731-.62393-.13454-.93675-.19277a49.13015,49.13015,0,0,0-35.29737,6.1847c-19.45809,12.26176-29.452,35.51036-32.69561,58.28426C112.8361,629.72786,124.40143,670.62755,154.44233,692.271Z"
                                        transform="translate(-116.01378 -185.5)" fill="#f1f1f1"/>
                                    <path
                                        d="M162.97318,633.5239a83.51853,83.51853,0,0,0,5.76411,23.53543A72.52018,72.52018,0,0,0,179.99707,675.451c9.49657,11.42369,22.05367,20.01238,35.691,25.73513a133.7282,133.7282,0,0,0,32.51657,8.737c4.62174-.32609,9.21077-.70874,13.75729-1.12157.02746-.00712.06353-.00458.09143-.01167.2185-.0208.43744-.04161.6465-.054.93841-.08779,1.87724-.1755,2.80685-.26387l-.2196.419-.68925,1.30024c.2477-.43517.49521-.86129.74291-1.29646.07285-.13062.15451-.26067.22693-.39138a73.92225,73.92225,0,0,1-20.71723-64.6648,74.55543,74.55543,0,0,1,13.89631-31.86317c-.93085-.28285-1.8743-.51228-2.82845-.71534a77.3,77.3,0,0,0-7.0511,11.67872,75.7417,75.7417,0,0,0-6.53473,47.11952,77.43753,77.43753,0,0,0,19.61965,38.62482c-.88275-.06222-1.77409-.1341-2.64633-.21369-16.52166-1.39976-33.00967-4.9516-47.995-12.22685a86.44054,86.44054,0,0,1-32.382-26.57c-9.07565-12.51653-13.07481-27.5721-13.7618-42.87405-.72844-16.38207,1.39716-33.05187,5.13582-48.9833a205.59724,205.59724,0,0,1,17.27595-47.05958,1.47818,1.47818,0,0,0-.58694-1.95143,1.25724,1.25724,0,0,0-.93675-.19277,1.09451,1.09451,0,0,0-.72256.619c-.94456,1.8435-1.87153,3.68824-2.76326,5.55359a207.93123,207.93123,0,0,0-16.2775,48.82276C163.00752,599.89618,161.25452,616.93624,162.97318,633.5239Z"
                                        transform="translate(-116.01378 -185.5)" fill="#fff"/>
                                    <path d="M498.01378,714.5h-381a1,1,0,0,1,0-2h381a1,1,0,0,1,0,2Z"
                                          transform="translate(-116.01378 -185.5)" fill="#cbcbcb"/>
                                    <path
                                        d="M383.64443,445.9675,366.417,361.55189l-7.56774-62.3493-16.76577,10.846,2.31606,68.709,26.75976,71.18916a9.32773,9.32773,0,1,0,12.48513-3.97927Z"
                                        transform="translate(-116.01378 -185.5)" fill="#ffb7b7"/>
                                    <path
                                        d="M222.51709,452.49467l4.76864-86.02349-1.5795-62.787,22.16477,8.29264,3.70019,68.31545-16.123,74.32382a9.32774,9.32774,0,1,1-12.93108-2.12139Z"
                                        transform="translate(-116.01378 -185.5)" fill="#ffb7b7"/>
                                    <polygon
                                        points="152.925 517.096 164.25 517.095 169.638 473.411 152.923 473.412 152.925 517.096"
                                        fill="#ffb7b7"/>
                                    <path
                                        d="M266.04945,698.89831l22.3041-.00091h.00091a14.2147,14.2147,0,0,1,14.21392,14.2137v.4619l-36.51825.00135Z"
                                        transform="translate(-116.01378 -185.5)" fill="#2f2e41"/>
                                    <polygon
                                        points="195.822 512.084 207.014 513.815 219.018 471.469 202.5 468.914 195.822 512.084"
                                        fill="#ffb7b7"/>
                                    <path
                                        d="M309.54612,693.48825l22.042,3.40954.00089.00014a14.2147,14.2147,0,0,1,11.87341,16.22l-.07063.45646-36.089-5.58254Z"
                                        transform="translate(-116.01378 -185.5)" fill="#2f2e41"/>
                                    <path
                                        d="M265.61172,689.55283l-.0587-.31681L224.55262,467.5608a83.73918,83.73918,0,0,1,7.39968-52.36494l24.81587-49.63139,74.0481,10.03176,8.73894,63.18874,31.14228,120.5417-.03084.09813-39.9,126.74124-26.14988,1.72,23.164-113.13449-42.41449-96.33649L288.358,687.8293Z"
                                        transform="translate(-116.01378 -185.5)" fill="#2f2e41"/>
                                    <path
                                        d="M332.54,383.683l-.48871-.76574c-.08779-.13808-9.08238-13.68946-33.55867-4.64142-24.98636,9.23833-44.34706-8.60472-44.53981-8.7859l-.09585-.09042-5.65862-50.43534-6.68-40.94362,21.264-3.73059,10.45424-6.27209,41.57111-.74016,10.93945,8.604,17.96045,1.95729,1.64416,37.307-.00754.04065Z"
                                        transform="translate(-116.01378 -185.5)" fill="#f9a826"/>
                                    <path
                                        d="M338.49789,318.75458v-31.945l5.05057-9.21731.20537-.00631a15.14058,15.14058,0,0,1,10.46072,4.75287c5.08,5.1615,7.38128,13.761,6.84,25.55936l-.01.21588Z"
                                        transform="translate(-116.01378 -185.5)" fill="#f9a826"/>
                                    <path
                                        d="M250.46647,315.28227,224.72452,312.193l-.02015-.29649c-.87824-12.8368,1.36239-22.36567,6.65951-28.32129,4.80754-5.40507,10.31616-5.73239,10.54834-5.74361l.14859-.007,6.96844,6.33482Z"
                                        transform="translate(-116.01378 -185.5)" fill="#f9a826"/>
                                    <path
                                        d="M324.98425,254.40579h-67.7379a5.26145,5.26145,0,0,1-5.25552-5.25553V224.62447a39.12447,39.12447,0,0,1,78.24894,0v24.52579A5.26145,5.26145,0,0,1,324.98425,254.40579Z"
                                        transform="translate(-116.01378 -185.5)" fill="#2f2e41"/>
                                    <circle cx="292.68782" cy="225.4797" r="28.68469"
                                            transform="translate(-161.56464 188.64661) rotate(-61.33685)"
                                            fill="#ffb7b7"/>
                                    <path
                                        d="M319.95312,226.37631H282.08236a2.924,2.924,0,0,1-2.89721-2.55819l-.49042-3.92225a1.75171,1.75171,0,0,0-3.32576-.5235l-2.48264,5.31939a2.931,2.931,0,0,1-2.64572,1.68455H264.4881a2.91919,2.91919,0,0,1-2.90662-3.198l2.26821-23.69207a2.94218,2.94218,0,0,1,1.66859-2.378c17.34363-8.09656,34.93134-8.0863,52.275.0308a2.924,2.924,0,0,1,1.652,2.24112l3.3979,23.66128a2.91891,2.91891,0,0,1-2.89008,3.33488Z"
                                        transform="translate(-116.01378 -185.5)" fill="#2f2e41"/>
                                    <polygon
                                        points="267.719 265.859 266.305 264.445 327.767 202.982 446.875 202.982 506.97 141.647 624.539 141.647 683.855 81.869 959.972 81.869 959.972 83.869 684.688 83.869 625.372 143.647 507.81 143.647 447.715 204.982 328.596 204.982 267.719 265.859"
                                        fill="#3f3d56"/>
                                    <circle cx="508.97244" cy="143" r="37" fill="#fff"/>
                                    <circle cx="684.97244" cy="83" r="10" fill="#cbcbcb"/>
                                    <circle cx="957.97244" cy="83" r="10" fill="#cbcbcb"/>
                                    <circle cx="821.97244" cy="83" r="10" fill="#cbcbcb"/>
                                    <path
                                        d="M624.98622,366.5a38,38,0,1,1,38-38A38.04307,38.04307,0,0,1,624.98622,366.5Zm0-74a36,36,0,1,0,36,36A36.04061,36.04061,0,0,0,624.98622,292.5Z"
                                        transform="translate(-116.01378 -185.5)" fill="#3f3d56"/>
                                    <circle cx="508.97244" cy="143" r="26.43632" fill="#f9a826"/>
                                    <polygon
                                        points="506.453 154.16 498.541 143.986 503.142 140.407 506.889 145.224 519.545 131.863 523.777 135.873 506.453 154.16"
                                        fill="#fff"/>
                                    <circle cx="326.97244" cy="204" r="37" fill="#fff"/>
                                    <path
                                        d="M442.98622,427.5a38,38,0,1,1,38-38A38.04315,38.04315,0,0,1,442.98622,427.5Zm0-74a36,36,0,1,0,36,36A36.0407,36.0407,0,0,0,442.98622,353.5Z"
                                        transform="translate(-116.01378 -185.5)" fill="#3f3d56"/>
                                    <circle cx="326.97244" cy="204" r="26.43632" fill="#f9a826"/>
                                    <polygon
                                        points="324.453 215.16 316.541 204.986 321.142 201.407 324.889 206.224 337.545 192.863 341.777 196.873 324.453 215.16"
                                        fill="#fff"/>
                                </svg>
                                <hr>
                            </div>

                            <div class="card-body  mh-75 d-flex flex-column align-items-start justify-content-evenly  ">

                                <div class="mh-15 overflow-hidden text-break">
                                    <i class="fa-regular fa-circle"></i> {{__('myOrdersPage.Name')}} : {{$order->name}}
                                </div>
                                <div class="mh-30 overflow-hidden text-break">
                                    <i class="fa-regular fa-circle"></i> {{__('myOrdersPage.Description')}}
                                    : {{$order->description}}
                                </div>

                                <div class="mh-30 overflow-hidden  text-break">
                                    <i class="fa-solid fa-note-sticky"></i> {{__('myOrdersPage.Notes')}}
                                    : {{$order->notes}}
                                </div>

                                <div class=" mh-15 overflow-hidden text-break">
                                    <i class="fa-solid fa-share-from-square"></i> {{__('myOrdersPage.FromAddress')}} :
                                    <span class="">{{$order->from_address}} </span>
                                </div>
                                <div class=" mh-15 overflow-hidden text-break">
                                    <i class="fa-solid fa-right-to-bracket"></i> {{__('myOrdersPage.ToAddress')}} :
                                    <span class="">{{$order->to_address}}</span>
                                </div>
                            </div>

                            <div class="card-footer ">
                                    <div class="btn-group col-12">
                                        <button class="btn btn-secondary col-6 rounded-0" data-bs-toggle="modal"
                                                data-bs-target="#addBrandModal">{{__('myOrdersPage.Delete')}}
                                        </button>
                                        <button class="btn btn-primary col-6 rounded-0" data-bs-toggle="modal"
                                                data-bs-target="#editOrderModal" wire:click="editOrder({{$order->id}})">
                                            {{__('myOrdersPage.OrderAgain')}}
                                        </button>
                                    </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="position-absolute top-50 start-50 translate-middle d-flex flex-column align-items-center justify-content-center h-250-px">
                            <svg class="w-100 h-100" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"
                                 width="797.5" height="834.5" viewBox="0 0 797.5 834.5"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"><title>void</title>
                                <ellipse cx="308.5" cy="780" rx="308.5" ry="54.5" fill="#3f3d56"/>
                                <circle cx="496" cy="301.5" r="301.5" fill="#3f3d56"/>
                                <circle cx="496" cy="301.5" r="248.89787" opacity="0.05"/>
                                <circle cx="496" cy="301.5" r="203.99362" opacity="0.05"/>
                                <circle cx="496" cy="301.5" r="146.25957" opacity="0.05"/>
                                <path
                                    d="M398.42029,361.23224s-23.70394,66.72221-13.16886,90.42615,27.21564,46.52995,27.21564,46.52995S406.3216,365.62186,398.42029,361.23224Z"
                                    transform="translate(-201.25 -32.75)" fill="#d0cde1"/>
                                <path
                                    d="M398.42029,361.23224s-23.70394,66.72221-13.16886,90.42615,27.21564,46.52995,27.21564,46.52995S406.3216,365.62186,398.42029,361.23224Z"
                                    transform="translate(-201.25 -32.75)" opacity="0.1"/>
                                <path
                                    d="M415.10084,515.74682s-1.75585,16.68055-2.63377,17.55847.87792,2.63377,0,5.26754-1.75585,6.14547,0,7.02339-9.65716,78.13521-9.65716,78.13521-28.09356,36.8728-16.68055,94.81576l3.51169,58.82089s27.21564,1.75585,27.21564-7.90132c0,0-1.75585-11.413-1.75585-16.68055s4.38962-5.26754,1.75585-7.90131-2.63377-4.38962-2.63377-4.38962,4.38961-3.51169,3.51169-4.38962,7.90131-63.2105,7.90131-63.2105,9.65716-9.65716,9.65716-14.92471v-5.26754s4.38962-11.413,4.38962-12.29093,23.70394-54.43127,23.70394-54.43127l9.65716,38.62864,10.53509,55.3092s5.26754,50.04165,15.80262,69.356c0,0,18.4364,63.21051,18.4364,61.45466s30.72733-6.14547,29.84941-14.04678-18.4364-118.5197-18.4364-118.5197L533.62054,513.991Z"
                                    transform="translate(-201.25 -32.75)" fill="#2f2e41"/>
                                <path
                                    d="M391.3969,772.97846s-23.70394,46.53-7.90131,48.2858,21.94809,1.75585,28.97148-5.26754c3.83968-3.83968,11.61528-8.99134,17.87566-12.87285a23.117,23.117,0,0,0,10.96893-21.98175c-.463-4.29531-2.06792-7.83444-6.01858-8.16366-10.53508-.87792-22.826-10.53508-22.826-10.53508Z"
                                    transform="translate(-201.25 -32.75)" fill="#2f2e41"/>
                                <path
                                    d="M522.20753,807.21748s-23.70394,46.53-7.90131,48.28581,21.94809,1.75584,28.97148-5.26754c3.83968-3.83969,11.61528-8.99134,17.87566-12.87285a23.117,23.117,0,0,0,10.96893-21.98175c-.463-4.29531-2.06792-7.83444-6.01857-8.16367-10.53509-.87792-22.826-10.53508-22.826-10.53508Z"
                                    transform="translate(-201.25 -32.75)" fill="#2f2e41"/>
                                <circle cx="295.90488" cy="215.43252" r="36.90462" fill="#ffb8b8"/>
                                <path
                                    d="M473.43048,260.30832S447.07,308.81154,444.9612,308.81154,492.41,324.62781,492.41,324.62781s13.70743-46.39439,15.81626-50.61206Z"
                                    transform="translate(-201.25 -32.75)" fill="#ffb8b8"/>
                                <path
                                    d="M513.86726,313.3854s-52.67543-28.97148-57.943-28.09356-61.45466,50.04166-60.57673,70.2339,7.90131,53.55335,7.90131,53.55335,2.63377,93.05991,7.90131,93.93783-.87792,16.68055.87793,16.68055,122.90931,0,123.78724-2.63377S513.86726,313.3854,513.86726,313.3854Z"
                                    transform="translate(-201.25 -32.75)" fill="#d0cde1"/>
                                <path
                                    d="M543.2777,521.89228s16.68055,50.91958,2.63377,49.16373-20.19224-43.89619-20.19224-43.89619Z"
                                    transform="translate(-201.25 -32.75)" fill="#ffb8b8"/>
                                <path
                                    d="M498.50359,310.31267s-32.48318,7.02339-27.21563,50.91957,14.9247,87.79237,14.9247,87.79237l32.48318,71.11182,3.51169,13.16886,23.70394-6.14547L528.353,425.32067s-6.14547-108.86253-14.04678-112.37423A33.99966,33.99966,0,0,0,498.50359,310.31267Z"
                                    transform="translate(-201.25 -32.75)" fill="#d0cde1"/>
                                <polygon points="277.5 414.958 317.885 486.947 283.86 411.09 277.5 414.958"
                                         opacity="0.1"/>
                                <path
                                    d="M533.896,237.31585l.122-2.82012,5.6101,1.39632a6.26971,6.26971,0,0,0-2.5138-4.61513l5.97581-.33413a64.47667,64.47667,0,0,0-43.1245-26.65136c-12.92583-1.87346-27.31837.83756-36.182,10.43045-4.29926,4.653-7.00067,10.57018-8.92232,16.60685-3.53926,11.11821-4.26038,24.3719,3.11964,33.40938,7.5006,9.18513,20.602,10.98439,32.40592,12.12114,4.15328.4,8.50581.77216,12.35457-.83928a29.721,29.721,0,0,0-1.6539-13.03688,8.68665,8.68665,0,0,1-.87879-4.15246c.5247-3.51164,5.20884-4.39635,8.72762-3.9219s7.74984,1.20031,10.062-1.49432c1.59261-1.85609,1.49867-4.559,1.70967-6.99575C521.28248,239.785,533.83587,238.70653,533.896,237.31585Z"
                                    transform="translate(-201.25 -32.75)" fill="#2f2e41"/>
                                <circle cx="559" cy="744.5" r="43" fill="#f9a826"/>
                                <circle cx="54" cy="729.5" r="43" fill="#f9a826"/>
                                <circle cx="54" cy="672.5" r="31" fill="#f9a826"/>
                                <circle cx="54" cy="624.5" r="22" fill="#f9a826"/>
                            </svg>
                            <h3>No Data</h3>
                        </div>

                    @endforelse
                </div>
                {{$orders->links()}}
            </div>
        </section>

        @include('livewire.front.inc.modals')
    </div>
</div>

@push('scripts')
    <script>
        window.addEventListener('close-modal', function () {
            $('#editOrderModal').modal('hide');
        });
    </script>
@endpush

