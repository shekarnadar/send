@extends('layouts.app')
@section('title', 'Login')
@section('content')
<main>
   <div class="vd jd tto vv oq ar ri">
      <div class="td py va jp rounded-sm lq ry">
         <div class="tp tw tk sk s_ pointer-events-none hidden tnn" aria-hidden="true">
            <svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
               <defs>
                  <path id="welcome-a" d="M64 0l64 128-64-20-64 20z"></path>
                  <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z"></path>
                  <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z"></path>
                  <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="welcome-b">
                     <stop stop-color="#A5B4FC" offset="0%"></stop>
                     <stop stop-color="#818CF8" offset="100%"></stop>
                  </linearGradient>
                  <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                     <stop stop-color="#4338CA" offset="0%"></stop>
                     <stop stop-color="#6366F1" stop-opacity="0" offset="100%"></stop>
                  </linearGradient>
               </defs>
               <g fill="none" fill-rule="evenodd">
                  <g transform="rotate(64 36.592 105.604)">
                     <mask id="welcome-d" fill="#fff">
                        <use xlink:href="#welcome-a"></use>
                     </mask>
                     <use fill="url(#welcome-b)" xlink:href="#welcome-a"></use>
                     <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z"></path>
                  </g>
                  <g transform="rotate(-51 91.324 -105.372)">
                     <mask id="welcome-f" fill="#fff">
                        <use xlink:href="#welcome-e"></use>
                     </mask>
                     <use fill="url(#welcome-b)" xlink:href="#welcome-e"></use>
                     <path fill="url(#welcome-c)" mask="url(#welcome-f)" d="M40.333-15.147h50v95h-50z"></path>
                  </g>
                  <g transform="rotate(44 61.546 392.623)">
                     <mask id="welcome-h" fill="#fff">
                        <use xlink:href="#welcome-g"></use>
                     </mask>
                     <use fill="url(#welcome-b)" xlink:href="#welcome-g"></use>
                     <path fill="url(#welcome-c)" mask="url(#welcome-h)" d="M40.333-15.147h50v95h-50z"></path>
                  </g>
               </g>
            </svg>
         </div>
         <div class="td">
            <h1 class="gg zj text-slate-800 font-bold rx">Good afternoon, Acme Inc. 👋</h1>
            <p>Here is what’s happening with your projects today:</p>
         </div>
      </div>
      <div class="_y js jn ry">
         <ul class="flex flex-wrap justify-center jr ry _a lf si">
            <li> <a class="block" href="#0"> <img class="uo oa rounded-full" src="{{url('assets/images/user-36-01.jpg')}}" width="36" height="36" alt="User 01"> </a> </li>
            <li> <a class="block" href="#0"> <img class="uo oa rounded-full" src="{{url('assets/images/user-36-02.jpg')}}" width="36" height="36" alt="User 02"> </a> </li>
            <li> <a class="block" href="#0"> <img class="uo oa rounded-full" src="{{url('assets/images/user-36-03.jpg')}}" width="36" height="36" alt="User 03"> </a> </li>
            <li> <a class="block" href="#0"> <img class="uo oa rounded-full" src="{{url('assets/images/user-36-04.jpg')}}" width="36" height="36" alt="User 04"> </a> </li>
            <li>
               <button class="flex justify-center items-center uo oa rounded-full bg-white border border-slate-200 hover--border-slate-300 text-indigo-500 bw wr wu r_">
                  <span class="tc">Add new user</span> 
                  <svg class="ue on db" viewBox="0 0 16 16">
                     <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z"></path>
                  </svg>
               </button>
            </li>
         </ul>
         <div class="sq fa _j fm ji fy">
            <div class="td inline-flex" x-data="{ open: false }">
               <button class="btn bg-white border-slate-200 hover--border-slate-300 text-slate-500 hover--text-slate-600" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
                  <span class="tc">Filter</span><wbr> 
                  <svg class="ue on db" viewBox="0 0 16 16">
                     <path d="M9 15H7a1 1 0 010-2h2a1 1 0 010 2zM11 11H5a1 1 0 010-2h6a1 1 0 010 2zM13 7H3a1 1 0 010-2h10a1 1 0 010 2zM15 3H1a1 1 0 010-2h14a1 1 0 010 2z"></path>
                  </svg>
               </button>
               <div class="am nv tp tq tb tg jz qe uq bg-white border border-slate-200 mp rounded by lq iu" @click.outside="open = false" @keydown.escape.window="open = false" x-show="open" x-transition:enter="wr wh wf fe" x-transition:enter-start="opacity-0 aw" x-transition:enter-end="bv ax" x-transition:leave="wr wh wf" x-transition:leave-start="bv" x-transition:leave-end="opacity-0" x-cloak="">
                  <div class="gb g_ yu gq mp mv vd">Filters</div>
                  <ul class="rw">
                     <li class="mt me"> <label class="flex items-center"> <input type="checkbox" class="to" checked="checked"> <span class="text-sm gk r_">Direct VS Indirect</span> </label> </li>
                     <li class="mt me"> <label class="flex items-center"> <input type="checkbox" class="to" checked="checked"> <span class="text-sm gk r_">Real Time Value</span> </label> </li>
                     <li class="mt me"> <label class="flex items-center"> <input type="checkbox" class="to" checked="checked"> <span class="text-sm gk r_">Top Channels</span> </label> </li>
                     <li class="mt me"> <label class="flex items-center"> <input type="checkbox" class="to"> <span class="text-sm gk r_">Sales VS Refunds</span> </label> </li>
                     <li class="mt me"> <label class="flex items-center"> <input type="checkbox" class="to"> <span class="text-sm gk r_">Last Order</span> </label> </li>
                     <li class="mt me"> <label class="flex items-center"> <input type="checkbox" class="to"> <span class="text-sm gk r_">Total Spent</span> </label> </li>
                  </ul>
                  <div class="vg me ck border-slate-200 hq">
                     <ul class="flex items-center fg">
                        <li> <button class="btn-xs bg-white border-slate-200 hover--border-slate-300 text-slate-500 hover--text-slate-600">Clear</button> </li>
                        <li> <button class="btn-xs hb xs yo" @click="open = false" @focusout="open = false">Apply</button> </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="td">
               <input class="datepicker tn mf text-slate-500 hover--text-slate-600 gk kn oz" placeholder="Select dates" data-class="flatpickr-right"> 
               <div class="tp tm tg flex items-center pointer-events-none">
                  <svg class="ue on db text-slate-500 ml-3" viewBox="0 0 16 16">
                     <path d="M15 2h-2V0h-2v2H9V0H7v2H5V0H3v2H1a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V3a1 1 0 00-1-1zm-1 12H2V6h12v8z"></path>
                  </svg>
               </div>
            </div>
            <button class="btn hb xs yo">
               <svg class="ue on db bh ap" viewBox="0 0 16 16">
                  <path d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z"></path>
               </svg>
               <span class="hidden tro r_">Add View</span> 
            </button>
         </div>
      </div>
      <!-- Cards -->
      <div class="sq ff fb">
         <!-- Line chart (Acme Plus) -->
         <div class="flex fh nk _s ttk bg-white by rounded-sm border border-slate-200">
            <div class="mn gn">
               <header class="flex fg fd in">
                  <img src="{{url('assets/images/icon-01.svg')}}" width="32" height="32" alt="Icon 01"> 
                  <div class="td inline-flex" x-data="{ open: false }">
                     <button class="yu xm rounded-full" :class="{ 'hy text-slate-500': open }" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
                        <span class="tc">Menu</span> 
                        <svg class="uu of db" viewBox="0 0 32 32">
                           <circle cx="16" cy="16" r="2"></circle>
                           <circle cx="10" cy="16" r="2"></circle>
                           <circle cx="22" cy="16" r="2"></circle>
                        </svg>
                     </button>
                     <div class="am nv tp tq tw ae bg-white border border-slate-200 ms rounded by lq iu" @click.outside="open = false" @keydown.escape.window="open = false" x-show="open" x-transition:enter="wr wh wf fe" x-transition:enter-start="opacity-0 aw" x-transition:enter-end="bv ax" x-transition:leave="wr wh wf" x-transition:leave-start="bv" x-transition:leave-end="opacity-0" x-cloak="">
                        <ul>
                           <li> <a class="gk text-sm ys xy flex mt me" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Option 1</a> </li>
                           <li> <a class="gk text-sm ys xy flex mt me" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Option 2</a> </li>
                           <li> <a class="gk text-sm yl xb flex mt me" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Remove</a> </li>
                        </ul>
                     </div>
                  </div>
               </header>
               <h2 class="gx g_ text-slate-800 in">Acme Plus</h2>
               <div class="gb g_ yu gq rx">Sales</div>
               <div class="flex fd">
                  <div class="text-3xl font-bold text-slate-800 mr-2">$24,780</div>
                  <div class="text-sm g_ yo mi hk rounded-full">+49%</div>
               </div>
            </div>
            <div class="ad">
               <canvas id="dashboard-card-01" width="389" height="128"></canvas>
            </div>
         </div>
         <!-- Line chart (Acme Advanced) -->
         <div class="flex fh nk _s ttk bg-white by rounded-sm border border-slate-200">
            <div class="mn gn">
               <header class="flex fg fd in">
                  <img src="{{url('assets/images/icon-02.svg')}}" width="32" height="32" alt="Icon 02"> 
                  <div class="td inline-flex" x-data="{ open: false }">
                     <button class="yu xm rounded-full" :class="{ 'hy text-slate-500': open }" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
                        <span class="tc">Menu</span> 
                        <svg class="uu of db" viewBox="0 0 32 32">
                           <circle cx="16" cy="16" r="2"></circle>
                           <circle cx="10" cy="16" r="2"></circle>
                           <circle cx="22" cy="16" r="2"></circle>
                        </svg>
                     </button>
                     <div class="am nv tp tq tw ae bg-white border border-slate-200 ms rounded by lq iu" @click.outside="open = false" @keydown.escape.window="open = false" x-show="open" x-transition:enter="wr wh wf fe" x-transition:enter-start="opacity-0 aw" x-transition:enter-end="bv ax" x-transition:leave="wr wh wf" x-transition:leave-start="bv" x-transition:leave-end="opacity-0" x-cloak="">
                        <ul>
                           <li> <a class="gk text-sm ys xy flex mt me" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Option 1</a> </li>
                           <li> <a class="gk text-sm ys xy flex mt me" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Option 2</a> </li>
                           <li> <a class="gk text-sm yl xb flex mt me" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Remove</a> </li>
                        </ul>
                     </div>
                  </div>
               </header>
               <h2 class="gx g_ text-slate-800 in">Acme Advanced</h2>
               <div class="gb g_ yu gq rx">Sales</div>
               <div class="flex fd">
                  <div class="text-3xl font-bold text-slate-800 mr-2">$17,489</div>
                  <div class="text-sm g_ yo mi hj rounded-full">-14%</div>
               </div>
            </div>
            <div class="ad">
               <canvas id="dashboard-card-02" width="389" height="128"></canvas>
            </div>
         </div>
         <!-- Line chart (Acme Professional) -->
         <div class="flex fh nk _s ttk bg-white by rounded-sm border border-slate-200">
            <div class="mn gn">
               <header class="flex fg fd in">
                  <img src="{{url('assets/images/icon-03.svg')}}" width="32" height="32" alt="Icon 03"> 
                  <div class="td inline-flex" x-data="{ open: false }">
                     <button class="yu xm rounded-full" :class="{ 'hy text-slate-500': open }" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open">
                        <span class="tc">Menu</span> 
                        <svg class="uu of db" viewBox="0 0 32 32">
                           <circle cx="16" cy="16" r="2"></circle>
                           <circle cx="10" cy="16" r="2"></circle>
                           <circle cx="22" cy="16" r="2"></circle>
                        </svg>
                     </button>
                     <div class="am nv tp tq tw ae bg-white border border-slate-200 ms rounded by lq iu" @click.outside="open = false" @keydown.escape.window="open = false" x-show="open" x-transition:enter="wr wh wf fe" x-transition:enter-start="opacity-0 aw" x-transition:enter-end="bv ax" x-transition:leave="wr wh wf" x-transition:leave-start="bv" x-transition:leave-end="opacity-0" x-cloak="">
                        <ul>
                           <li> <a class="gk text-sm ys xy flex mt me" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Option 1</a> </li>
                           <li> <a class="gk text-sm ys xy flex mt me" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Option 2</a> </li>
                           <li> <a class="gk text-sm yl xb flex mt me" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Remove</a> </li>
                        </ul>
                     </div>
                  </div>
               </header>
               <h2 class="gx g_ text-slate-800 in">Acme Professional</h2>
               <div class="gb g_ yu gq rx">Sales</div>
               <div class="flex fd">
                  <div class="text-3xl font-bold text-slate-800 mr-2">$9,962</div>
                  <div class="text-sm g_ yo mi hk rounded-full">+29%</div>
               </div>
            </div>
            <div class="ad">
               <canvas id="dashboard-card-03" width="389" height="128"></canvas>
            </div>
         </div>
         <!-- Bar chart (Direct vs Indirect) -->
         <div class="flex fh nk _s bg-white by rounded-sm border border-slate-200">
            <header class="mn mr cx hp">
               <h2 class="g_ text-slate-800">Direct VS Indirect</h2>
            </header>
            <div id="dashboard-card-04-legend" class="mn vm">
               <ul class="flex flex-wrap"></ul>
            </div>
            <div class="ad">
               <canvas id="dashboard-card-04" width="595" height="248"></canvas>
            </div>
         </div>
         <!-- Line chart (Real Time Value) -->
         <div class="flex fh nk _s bg-white by rounded-sm border border-slate-200">
            <header class="mn mr cx hp flex items-center">
               <h2 class="g_ text-slate-800">Real Time Value</h2>
               <div class="td r_" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                  <button class="block" aria-haspopup="true" :aria-expanded="open" @focus="open = true" @focusout="open = false" @click.prevent=""> 
                  <svg class="ue on db yu" viewBox="0 0 16 16">
                     <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"></path>
                  </svg>
                  </button> 
                  <div class="nv tp tz ne fe ag">
                     <div class="bg-white border border-slate-200 vf rounded by lq in" x-show="open" x-transition:enter="wr wh wf fe" x-transition:enter-start="opacity-0 ak" x-transition:enter-end="bv ax" x-transition:leave="wr wh wf" x-transition:leave-start="bv" x-transition:leave-end="opacity-0" x-cloak="">
                        <div class="gb gp co">Built with <a class="bu" @focus="open = true" @focusout="open = false" href="https://www.chartjs.org/" target="_blank">Chart.js</a></div>
                     </div>
                  </div>
               </div>
            </header>
            <div class="mn vm">
               <div class="flex fd">
                  <div class="text-3xl font-bold text-slate-800 mr-2 ye">$<span id="dashboard-card-05-value">57.81</span></div>
                  <div id="dashboard-card-05-deviation" class="text-sm g_ yo mi rounded-full"></div>
               </div>
            </div>
            <div class="ad">
               <canvas id="dashboard-card-05" width="595" height="248"></canvas>
            </div>
         </div>
         <!-- Doughnut chart (Top Countries) -->
         <div class="flex fh nk _s ttk bg-white by rounded-sm border border-slate-200">
            <header class="mn mr cx hp">
               <h2 class="g_ text-slate-800">Top Countries</h2>
            </header>
            <div class="ad flex fh justify-center">
               <div>
                  <canvas id="dashboard-card-06" width="389" height="260"></canvas>
               </div>
               <div id="dashboard-card-06-legend" class="mn gs mc">
                  <ul class="flex flex-wrap justify-center -m-1"></ul>
               </div>
            </div>
         </div>
         <!-- Table (Top Channels) -->
         <div class="nk tt_ bg-white by rounded-sm border border-slate-200">
            <header class="mn mr cx hp">
               <h2 class="g_ text-slate-800">Top Channels</h2>
            </header>
            <div class="vf">
               <div class="lz">
                  <table class="av oq">
                     <thead class="gb gq yu hq rounded-sm">
                        <tr>
                           <th class="vc">
                              <div class="g_ gh">Source</div>
                           </th>
                           <th class="vc">
                              <div class="g_ gp">Visitors</div>
                           </th>
                           <th class="vc">
                              <div class="g_ gp">Revenues</div>
                           </th>
                           <th class="vc">
                              <div class="g_ gp">Sales</div>
                           </th>
                           <th class="vc">
                              <div class="g_ gp">Conversion</div>
                           </th>
                        </tr>
                     </thead>
                     <tbody class="text-sm gk lg lw">
                        <tr>
                           <td class="vc">
                              <div class="flex items-center">
                                 <svg class="ap mr-2 _f" width="36" height="36" viewBox="0 0 36 36">
                                    <circle fill="#24292E" cx="18" cy="18" r="18"></circle>
                                    <path d="M18 10.2c-4.4 0-8 3.6-8 8 0 3.5 2.3 6.5 5.5 7.6.4.1.5-.2.5-.4V24c-2.2.5-2.7-1-2.7-1-.4-.9-.9-1.2-.9-1.2-.7-.5.1-.5.1-.5.8.1 1.2.8 1.2.8.7 1.3 1.9.9 2.3.7.1-.5.3-.9.5-1.1-1.8-.2-3.6-.9-3.6-4 0-.9.3-1.6.8-2.1-.1-.2-.4-1 .1-2.1 0 0 .7-.2 2.2.8.6-.2 1.3-.3 2-.3s1.4.1 2 .3c1.5-1 2.2-.8 2.2-.8.4 1.1.2 1.9.1 2.1.5.6.8 1.3.8 2.1 0 3.1-1.9 3.7-3.7 3.9.3.4.6.9.6 1.6v2.2c0 .2.1.5.6.4 3.2-1.1 5.5-4.1 5.5-7.6-.1-4.4-3.7-8-8.1-8z" fill="#FFF"></path>
                                 </svg>
                                 <div class="text-slate-800">Github.com</div>
                              </div>
                           </td>
                           <td class="vc">
                              <div class="gp">2.4K</div>
                           </td>
                           <td class="vc">
                              <div class="gp yg">$3,877</div>
                           </td>
                           <td class="vc">
                              <div class="gp">267</div>
                           </td>
                           <td class="vc">
                              <div class="gp yj">4.7%</div>
                           </td>
                        </tr>
                        <tr>
                           <td class="vc">
                              <div class="flex items-center">
                                 <svg class="ap mr-2 _f" width="36" height="36" viewBox="0 0 36 36">
                                    <circle fill="#1DA1F2" cx="18" cy="18" r="18"></circle>
                                    <path d="M26 13.5c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4 0 1.6 1.1 2.9 2.6 3.2-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H10c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4c.7-.5 1.3-1.1 1.7-1.8z" fill="#FFF" fill-rule="nonzero"></path>
                                 </svg>
                                 <div class="text-slate-800">Twitter</div>
                              </div>
                           </td>
                           <td class="vc">
                              <div class="gp">2.2K</div>
                           </td>
                           <td class="vc">
                              <div class="gp yg">$3,426</div>
                           </td>
                           <td class="vc">
                              <div class="gp">249</div>
                           </td>
                           <td class="vc">
                              <div class="gp yj">4.4%</div>
                           </td>
                        </tr>
                        <tr>
                           <td class="vc">
                              <div class="flex items-center">
                                 <svg class="ap mr-2 _f" width="36" height="36" viewBox="0 0 36 36">
                                    <circle fill="#EA4335" cx="18" cy="18" r="18"></circle>
                                    <path d="M18 17v2.4h4.1c-.2 1-1.2 3-4 3-2.4 0-4.3-2-4.3-4.4 0-2.4 2-4.4 4.3-4.4 1.4 0 2.3.6 2.8 1.1l1.9-1.8C21.6 11.7 20 11 18.1 11c-3.9 0-7 3.1-7 7s3.1 7 7 7c4 0 6.7-2.8 6.7-6.8 0-.5 0-.8-.1-1.2H18z" fill="#FFF" fill-rule="nonzero"></path>
                                 </svg>
                                 <div class="text-slate-800">Google (organic)</div>
                              </div>
                           </td>
                           <td class="vc">
                              <div class="gp">2.0K</div>
                           </td>
                           <td class="vc">
                              <div class="gp yg">$2,444</div>
                           </td>
                           <td class="vc">
                              <div class="gp">224</div>
                           </td>
                           <td class="vc">
                              <div class="gp yj">4.2%</div>
                           </td>
                        </tr>
                        <tr>
                           <td class="vc">
                              <div class="flex items-center">
                                 <svg class="ap mr-2 _f" width="36" height="36" viewBox="0 0 36 36">
                                    <circle fill="#4BC9FF" cx="18" cy="18" r="18"></circle>
                                    <path d="M26 14.3c-.1 1.6-1.2 3.7-3.3 6.4-2.2 2.8-4 4.2-5.5 4.2-.9 0-1.7-.9-2.4-2.6C14 19.9 13.4 15 12 15c-.1 0-.5.3-1.2.8l-.8-1c.8-.7 3.5-3.4 4.7-3.5 1.2-.1 2 .7 2.3 2.5.3 2 .8 6.1 1.8 6.1.9 0 2.5-3.4 2.6-4 .1-.9-.3-1.9-2.3-1.1.8-2.6 2.3-3.8 4.5-3.8 1.7.1 2.5 1.2 2.4 3.3z" fill="#FFF" fill-rule="nonzero"></path>
                                 </svg>
                                 <div class="text-slate-800">Vimeo.com</div>
                              </div>
                           </td>
                           <td class="vc">
                              <div class="gp">1.9K</div>
                           </td>
                           <td class="vc">
                              <div class="gp yg">$2,236</div>
                           </td>
                           <td class="vc">
                              <div class="gp">220</div>
                           </td>
                           <td class="vc">
                              <div class="gp yj">4.2%</div>
                           </td>
                        </tr>
                        <tr>
                           <td class="vc">
                              <div class="flex items-center">
                                 <svg class="ap mr-2 _f" width="36" height="36" viewBox="0 0 36 36">
                                    <circle fill="#0E2439" cx="18" cy="18" r="18"></circle>
                                    <path d="M14.232 12.818V23H11.77V12.818h2.46zM15.772 23V12.818h2.462v4.087h4.012v-4.087h2.456V23h-2.456v-4.092h-4.012V23h-2.461z" fill="#E6ECF4"></path>
                                 </svg>
                                 <div class="text-slate-800">Indiehackers.com</div>
                              </div>
                           </td>
                           <td class="vc">
                              <div class="gp">1.7K</div>
                           </td>
                           <td class="vc">
                              <div class="gp yg">$2,034</div>
                           </td>
                           <td class="vc">
                              <div class="gp">204</div>
                           </td>
                           <td class="vc">
                              <div class="gp yj">3.9%</div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <!-- Line chart (Sales Over Time) -->
         <div class="flex fh nk _s bg-white by rounded-sm border border-slate-200">
            <header class="mn mr cx hp flex items-center">
               <h2 class="g_ text-slate-800">Sales Over Time (all stores)</h2>
            </header>
            <div class="mn vm">
               <div class="flex flex-wrap fg fv">
                  <div class="flex fd">
                     <div class="text-3xl font-bold text-slate-800 mr-2">$1,482</div>
                     <div class="text-sm g_ yo mi hj rounded-full">-22%</div>
                  </div>
                  <div id="dashboard-card-08-legend" class="ad r_ rx">
                     <ul class="flex flex-wrap justify-end"></ul>
                  </div>
               </div>
            </div>
            <div class="ad">
               <canvas id="dashboard-card-08" width="595" height="248"></canvas>
            </div>
         </div>
         <!-- Stacked bar chart (Sales VS Refunds) -->
         <div class="flex fh nk _s bg-white by rounded-sm border border-slate-200">
            <header class="mn mr cx hp flex items-center">
               <h2 class="g_ text-slate-800">Sales VS Refunds</h2>
               <div class="td r_" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                  <button class="block" href="#0" aria-haspopup="true" :aria-expanded="open" @focus="open = true" @focusout="open = false" @click.prevent=""> 
                  <svg class="ue on db yu" viewBox="0 0 16 16">
                     <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"></path>
                  </svg>
                  </button> 
                  <div class="nv tp tz ne fe ag">
                     <div class="at bg-white border border-slate-200 vf rounded by lq in" x-show="open" x-transition:enter="wr wh wf fe" x-transition:enter-start="opacity-0 ak" x-transition:enter-end="bv ax" x-transition:leave="wr wh wf" x-transition:leave-start="bv" x-transition:leave-end="opacity-0" x-cloak="">
                        <div class="text-sm">Sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</div>
                     </div>
                  </div>
               </div>
            </header>
            <div class="mn vm">
               <div class="flex fd">
                  <div class="text-3xl font-bold text-slate-800 mr-2">+$6,796</div>
                  <div class="text-sm g_ yo mi hj rounded-full">-34%</div>
               </div>
            </div>
            <div class="ad">
               <canvas id="dashboard-card-09" width="595" height="248"></canvas>
            </div>
         </div>
         <!-- Card (Recent Activity) -->
         <div class="nk ttx bg-white by rounded-sm border border-slate-200">
            <header class="mn mr cx hp">
               <h2 class="g_ text-slate-800">Recent Activity</h2>
            </header>
            <div class="vf">
               <div>
                  <header class="gb gq yu hq rounded-sm g_ vc">Today</header>
                  <ul class="rp">
                     <li class="flex v_">
                        <div class="uo oa rounded-full ap hb rd rk">
                           <svg class="uo oa db text-indigo-50" viewBox="0 0 36 36">
                              <path d="M18 10c-4.4 0-8 3.1-8 7s3.6 7 8 7h.6l5.4 2v-4.4c1.2-1.2 2-2.8 2-4.6 0-3.9-3.6-7-8-7zm4 10.8v2.3L18.9 22H18c-3.3 0-6-2.2-6-5s2.7-5 6-5 6 2.2 6 5c0 2.2-2 3.8-2 3.8z"></path>
                           </svg>
                        </div>
                        <div class="ad flex items-center cx hp text-sm vg">
                           <div class="ad flex fg">
                              <div class="l_"><a class="gk text-slate-800 xk" href="#0">Nick Mark</a> mentioned <a class="gk text-slate-800" href="#0">Sara Smith</a> in a new post</div>
                              <div class="ap lk r_"> <a class="gk text-indigo-500 xd" href="#0">View<span class="hidden _g"> -&gt;</span></a> </div>
                           </div>
                        </div>
                     </li>
                     <li class="flex v_">
                        <div class="uo oa rounded-full ap pr rd rk">
                           <svg class="uo oa db yk" viewBox="0 0 36 36">
                              <path d="M25 24H11a1 1 0 01-1-1v-5h2v4h12v-4h2v5a1 1 0 01-1 1zM14 13h8v2h-8z"></path>
                           </svg>
                        </div>
                        <div class="ad flex items-center cx hp text-sm vg">
                           <div class="ad flex fg">
                              <div class="l_">The post <a class="gk text-slate-800" href="#0">Post Name</a> was removed by <a class="gk text-slate-800 xk" href="#0">Nick Mark</a></div>
                              <div class="ap lk r_"> <a class="gk text-indigo-500 xd" href="#0">View<span class="hidden _g"> -&gt;</span></a> </div>
                           </div>
                        </div>
                     </li>
                     <li class="flex v_">
                        <div class="uo oa rounded-full ap hk rd rk">
                           <svg class="uo oa db yc" viewBox="0 0 36 36">
                              <path d="M15 13v-3l-5 4 5 4v-3h8a1 1 0 000-2h-8zM21 21h-8a1 1 0 000 2h8v3l5-4-5-4v3z"></path>
                           </svg>
                        </div>
                        <div class="ad flex items-center text-sm vg">
                           <div class="ad flex fg">
                              <div class="l_"><a class="gk text-slate-800 xk" href="#0">Patrick Sullivan</a> published a new <a class="gk text-slate-800" href="#0">post</a></div>
                              <div class="ap lk r_"> <a class="gk text-indigo-500 xd" href="#0">View<span class="hidden _g"> -&gt;</span></a> </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
               <div>
                  <header class="gb gq yu hq rounded-sm g_ vc">Yesterday</header>
                  <ul class="rp">
                     <li class="flex v_">
                        <div class="uo oa rounded-full ap hx rd rk">
                           <svg class="uo oa db y_" viewBox="0 0 36 36">
                              <path d="M23 11v2.085c-2.841.401-4.41 2.462-5.8 4.315-1.449 1.932-2.7 3.6-5.2 3.6h-1v2h1c3.5 0 5.253-2.338 6.8-4.4 1.449-1.932 2.7-3.6 5.2-3.6h3l-4-4zM15.406 16.455c.066-.087.125-.162.194-.254.314-.419.656-.872 1.033-1.33C15.475 13.802 14.038 13 12 13h-1v2h1c1.471 0 2.505.586 3.406 1.455zM24 21c-1.471 0-2.505-.586-3.406-1.455-.066.087-.125.162-.194.254-.316.422-.656.873-1.028 1.328.959.878 2.108 1.573 3.628 1.788V25l4-4h-3z"></path>
                           </svg>
                        </div>
                        <div class="ad flex items-center cx hp text-sm vg">
                           <div class="ad flex fg">
                              <div class="l_"><a class="gk text-slate-800 xk" href="#0">240+</a> users have subscribed to <a class="gk text-slate-800" href="#0">Newsletter #1</a></div>
                              <div class="ap lk r_"> <a class="gk text-indigo-500 xd" href="#0">View<span class="hidden _g"> -&gt;</span></a> </div>
                           </div>
                        </div>
                     </li>
                     <li class="flex v_">
                        <div class="uo oa rounded-full ap hb rd rk">
                           <svg class="uo oa db text-indigo-50" viewBox="0 0 36 36">
                              <path d="M18 10c-4.4 0-8 3.1-8 7s3.6 7 8 7h.6l5.4 2v-4.4c1.2-1.2 2-2.8 2-4.6 0-3.9-3.6-7-8-7zm4 10.8v2.3L18.9 22H18c-3.3 0-6-2.2-6-5s2.7-5 6-5 6 2.2 6 5c0 2.2-2 3.8-2 3.8z"></path>
                           </svg>
                        </div>
                        <div class="ad flex items-center text-sm vg">
                           <div class="ad flex fg">
                              <div class="l_">The post <a class="gk text-slate-800" href="#0">Post Name</a> was suspended by <a class="gk text-slate-800 xk" href="#0">Nick Mark</a></div>
                              <div class="ap lk r_"> <a class="gk text-indigo-500 xd" href="#0">View<span class="hidden _g"> -&gt;</span></a> </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <!-- Card (Income/Expenses) -->
         <div class="nk ttx bg-white by rounded-sm border border-slate-200">
            <header class="mn mr cx hp">
               <h2 class="g_ text-slate-800">Income/Expenses</h2>
            </header>
            <div class="vf">
               <div>
                  <header class="gb gq yu hq rounded-sm g_ vc">Today</header>
                  <ul class="rp">
                     <li class="flex v_">
                        <div class="uo oa rounded-full ap pr rd rk">
                           <svg class="uo oa db yk" viewBox="0 0 36 36">
                              <path d="M17.7 24.7l1.4-1.4-4.3-4.3H25v-2H14.8l4.3-4.3-1.4-1.4L11 18z"></path>
                           </svg>
                        </div>
                        <div class="ad flex items-center cx hp text-sm vg">
                           <div class="ad flex fg">
                              <div class="l_"><a class="gk text-slate-800 xk" href="#0">Qonto</a> billing</div>
                              <div class="ap lx r_"> <span class="gk text-slate-800">-$49.88</span> </div>
                           </div>
                        </div>
                     </li>
                     <li class="flex v_">
                        <div class="uo oa rounded-full ap hk rd rk">
                           <svg class="uo oa db yc" viewBox="0 0 36 36">
                              <path d="M18.3 11.3l-1.4 1.4 4.3 4.3H11v2h10.2l-4.3 4.3 1.4 1.4L25 18z"></path>
                           </svg>
                        </div>
                        <div class="ad flex items-center cx hp text-sm vg">
                           <div class="ad flex fg">
                              <div class="l_"><a class="gk text-slate-800 xk" href="#0">Cruip.com</a> Market Ltd 70 Wilson St London</div>
                              <div class="ap lx r_"> <span class="gk yg">+249.88</span> </div>
                           </div>
                        </div>
                     </li>
                     <li class="flex v_">
                        <div class="uo oa rounded-full ap hk rd rk">
                           <svg class="uo oa db yc" viewBox="0 0 36 36">
                              <path d="M18.3 11.3l-1.4 1.4 4.3 4.3H11v2h10.2l-4.3 4.3 1.4 1.4L25 18z"></path>
                           </svg>
                        </div>
                        <div class="ad flex items-center cx hp text-sm vg">
                           <div class="ad flex fg">
                              <div class="l_"><a class="gk text-slate-800 xk" href="#0">Notion Labs Inc</a></div>
                              <div class="ap lx r_"> <span class="gk yg">+99.99</span> </div>
                           </div>
                        </div>
                     </li>
                     <li class="flex v_">
                        <div class="uo oa rounded-full ap hk rd rk">
                           <svg class="uo oa db yc" viewBox="0 0 36 36">
                              <path d="M18.3 11.3l-1.4 1.4 4.3 4.3H11v2h10.2l-4.3 4.3 1.4 1.4L25 18z"></path>
                           </svg>
                        </div>
                        <div class="ad flex items-center cx hp text-sm vg">
                           <div class="ad flex fg">
                              <div class="l_"><a class="gk text-slate-800 xk" href="#0">Market Cap Ltd</a></div>
                              <div class="ap lx r_"> <span class="gk yg">+1,200.88</span> </div>
                           </div>
                        </div>
                     </li>
                     <li class="flex v_">
                        <div class="uo oa rounded-full ap hw rd rk">
                           <svg class="uo oa db yu" viewBox="0 0 36 36">
                              <path d="M21.477 22.89l-8.368-8.367a6 6 0 008.367 8.367zm1.414-1.413a6 6 0 00-8.367-8.367l8.367 8.367zM18 26a8 8 0 110-16 8 8 0 010 16z"></path>
                           </svg>
                        </div>
                        <div class="ad flex items-center cx hp text-sm vg">
                           <div class="ad flex fg">
                              <div class="l_"><a class="gk text-slate-800 xk" href="#0">App.com</a> Market Ltd 70 Wilson St London</div>
                              <div class="ap lx r_"> <span class="gk text-slate-800 ba">+$99.99</span> </div>
                           </div>
                        </div>
                     </li>
                     <li class="flex v_">
                        <div class="uo oa rounded-full ap pr rd rk">
                           <svg class="uo oa db yk" viewBox="0 0 36 36">
                              <path d="M17.7 24.7l1.4-1.4-4.3-4.3H25v-2H14.8l4.3-4.3-1.4-1.4L11 18z"></path>
                           </svg>
                        </div>
                        <div class="ad flex items-center text-sm vg">
                           <div class="ad flex fg">
                              <div class="l_"><a class="gk text-slate-800 xk" href="#0">App.com</a> Market Ltd 70 Wilson St London</div>
                              <div class="ap lx r_"> <span class="gk text-slate-800">-$49.88</span> </div>
                           </div>
                        </div>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection