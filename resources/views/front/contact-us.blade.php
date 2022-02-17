<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (View::hasSection('title')) @yield('title') - @endif{{ config('app.name', 'Astar') }}
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{asset('assets/images/favicon.png')}}">
    <script type="text/javascript">
        window.route = {
            root: "{{ config('app.url') }}"
        };
    </script>

    <script src="{{ asset('assets/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/js/front.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/izitoast/css/iziToast.min.css ') }}">
    <link href="{{ asset('assets/css/public.css') }}" rel="stylesheet">

    <meta name="description" content="{{ config('app.name', 'Astar') }}" />
    <meta itemprop="description" content="{{ config('app.name', 'Astar') }}" />
    <meta name="twitter:description" content="{{ config('app.name', 'Astar') }}" />

    <meta name="twitter:title" content="{{ config('app.name', 'Astar') }}" />
    <meta name="author" content="{{ config('app.name', 'Astar') }}" />

    <link rel="canonical" href="{{ url()->current() }}" />

    <meta name="twitter:site" content="@astar" />
    <meta name="twitter:creator" content="@astar" />

    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:title" content="A*STAR@30: 30 Innovations and Inventions"/>
    <meta property="og:description" content="2021 marks 30 years of A*STAR advancing scientific excellence, developing innovative technology and nurturing scientific talent for Singapore." />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="A*STAR" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta property="og:image:width" content="580" />
    <meta property="og:image:height" content="580" />

    <meta name="keywords" content= "A*STAR@30: 30 Innovations and Inventions" />

    <meta itemprop="name" content="#astar" />

    @if (View::hasSection('image'))
        <meta name="twitter:image" content="@yield('image')" />
        <meta property="og:image" content="@yield('image')" />
        <meta itemprop="image" content="@yield('image')" />
    @else
        <meta name="twitter:image" content="{{ asset('assets/images/site_brand.png') }}" />
        <meta property="og:image" content="{{ asset('assets/images/site_brand.png') }}" />
        <meta itemprop="image" content="{{ asset('assets/images/site_brand.png') }}" />
    @endif
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="javascript:void(0);"><img src="{{asset('assets/images/logo.png')}}" class="img-fluid" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('photobooth') }}">Photobooth</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('social-wall') }}">Social Wall</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('quiz') }}">quiz</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('special-thanks') }}">Special Thanks</a>
                        </li>
                    </ul>
                    @auth
                        <ul>
                            <li class="dropdown nav-item">
                                <button class="nav-link" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li>
                                        <form action="{{ route('logout') }}" class="d-inline-block" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn" title="Logout">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endauth
                </div>
            </div>
        </nav>

        <div class="special-block">
            <div class="container">
                <div class="heading-block">
                    <h1>Special Thanks</h1>
                    <p>The A<span>*</span>STAR@30: 30 Innovations and Inventions Over Three Decades publication was made possible through the collective effort of A<span>*</span>STAR and with the strong support from our partners in the R&D ecosystem.</p>
                </div>
                <div class="masonry">
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Scientific Advisors</h4>
                                <p>Sir David Lane, Jackie Y. Ying, Malini Olivo, Wan Yue, John Yong, Su Yi, Lye Kin Mun, Shawn Hoon, Eugene Wee, Wong Chia Woan</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Subcommittee members</h4>
                                <p>Germaine Shalla, Chew Chen Li, Lim Pei Zhen, Maggie Boo, Mazuin Mohd, Melissa Kam, Partha Pratim Kundu, Tng Tai Hou</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Apple Advanced Chinese Input Suite</h4>
                                <p>Chow Yen-Lu, Gareth Loudon, Tng Tai Hou, Daniel Lau, George Loo, Lin Zhiwei, Wu Yimin, James Pittman, Yuan Baosheng, Bai Shuanhu, and members of the Apple-ISS Research Centre</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Philips’ Sol-gel coating for irons</h4>
                                <p>Chang Soo-Kong, Jason Tan Gim Hong, Linda Wu Yong Ling, Liu Feng Min, Sandor Nemeth, Gerard Cnossen, Lee Poh Loo, Leo H.M. Krings, Marcel Boehmer, Peter Werkman</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Dextroscope: Virtual reality simulation</h4>
                                <p>Chris Goh Lin Chia, Ralf A Kockro, Eugene Lee Chee Keong, Ng Hern, Luis Serra</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>SARS virus genome sequencing and diagnostic kit</h4>
                                <p>Edison Liu, Liu Jianjun, Chia-Lin Wei, Ruan Yijun, Ee Chee Ren, Martin Hibberd, Lisa Ng</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Ultra-low flying height femto slider</h4>
                                <p>Zhang Mingsheng, Liu Bo, Leonard Gonzaga</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Liquid forging for high-performance metal alloys</h4>
                                <p>Chua Beng Wah, John Yong, Ho Meng Kwong, Peh Wee Yang</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Integrated Environment Modeller</h4>
                                <p>Poh Hee Joo, Lim Keng Hui, Lou Jing, Koh Wee Shing, Liu Enxiao, Wang Long, Bharathi Boppana, Wang Binfang, Zhao Weijiang, Daniel Wise, Liu Huizhe, Theint Theint Aye, Kang Chang Wei, Muthukumaran Ramalingam, Zhang Wenzu, Harish Gopalan, Venugopalan Raghavan, Senthil Kumar, Chua Kunting Eddie, Tan Sze Tiong, Li Wenhui Kelvin, Irene Lee Yen Leng, Fachmin Folianto, Adrian Tan Zeng Yi, Song Ying, Shu Haiyan, Chong Chiet Sing, Xu Xiangguo George, Kendrick Tan, Nguyen Vinh Tan, Cui Fangsen, Linus Ang, Ge Zhengwei, Fiona Liausvia, Jason Leong, Lu Xin, Bud Fox, Eng Yong</p>
                                <p>Poh Hee Joo, Lim Keng Hui, Lou Jing, Koh Wee Shing, Liu Enxiao, Wang Long, Bharathi Boppana, Wang Binfang, Zhao Weijiang, Daniel Wise, Liu Huizhe, Theint Theint Aye, Kang Chang Wei, Muthukumaran Ramalingam, Zhang Wenzu, Harish Gopalan, Venugopalan Raghavan, Senthil Kumar, Chua Kunting Eddie, Tan Sze Tiong, Li Wenhui Kelvin, Irene Lee Yen Leng, Fachmin Folianto, Adrian Tan Zeng Yi, Song Ying, Shu Haiyan, Chong Chiet Sing, Xu Xiangguo George, Kendrick Tan, Nguyen Vinh Tan, Cui Fangsen, Linus Ang, Ge Zhengwei, Fiona Liausvia, Jason Leong, Lu Xin, Bud Fox, Eng Yong</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Biomanufacturing platform for biologics production</h4>
                                <p>Yang Yuan Sheng, Mariati, Jessna Yeo</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Intelligent Court Transcription System</h4>
                                <p>Tran Huy Dat, Luong Trung Tuan, Tran Anh Dung, Helen Thai Ngoc Thuy Huong</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Auretek handheld probe</h4>
                                <p>Malini Olivo, Bi Renzhe</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Vitreogel</h4>
                                <p>Loh Xian Jun, Su Xin Yi</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Catalyst for converting CO2 to methane</h4>
                                <p>Chen Lu Wei, Poh Chee Kok, Armando Borgna, Teo Shi Chang, Daniel Ong Sze Wei, Tian Zhi Qun, Catherine K. S. Choong, Hiroyuki Kamata (IHI), Takuya Hashimoto (IHI), Kentaro Nariai (IHI), Noriki Mizukami (IHI)</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>SG Translate</h4>
                                <p>Aw Ai Ti , Wu Kui, Xiang Yuanxin, Zheng Weihua, Tarun Kumar Vangani, Nabilah Binte Md Johan, Siti Maryam Binte Ahmad Subaidi, Ding Yang, Nina Zhou</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>ETC-159 targets drug-resistant cancers</h4>
                                <p>David Virshup (Duke-NUS), Veronica Diermayr, Thomas Keller, Ho Soo Yei, Babita Madan (Duke-NUS), Lee May Ann, Kantharaj Ethirajulu, Dhananjay Umrani, Vincenzo</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Adaptive audio streaming technology with MPEG-4 SLS</h4>
                                <p>Susanto Rahardja, Yu Rongshan, Lin Xiao, Huang Haibin, Bao Xiaoming, Kelvin Lee, Shu Haiyan, Li Te</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>DropArray platform</h4>
                                <p>Jackie Y. Ying, Namyong Kim</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Silicon photonics</h4>
                                <p>Dim-Lee Kwong, Patrick Lo, Jason Liow, teams from the Institute of Microelectronics its spin-offs: Advanced Micro Foundry and Rain Tree Photonics</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Super Wi-Fi / TV White Space</h4>
                                <p>Pankaj Sharma, Chiu Ying Lay</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Co-axial stereo vision for 3D wire bond inspection</h4>
                                <p>Liu Tong, Yin Xiaoming, Li Xiang Leon</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Ultra-high resolution colour printing at 100,000 DPI</h4>
                                <p>Joel Yang, Dong Zhaogang, Goh Xiao Ming</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Digital pathology using an adaptive algorithm</h4>
                                <p>Hanry Yu</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>PRL3-zumab for more targeted cancer treatment</h4>
                                <p>Zeng Qi, Min Thura, Koon Hwee Ang, Jie Li</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Ballast Water Treatment System</h4>
                                <p>Li Hongying, Ba Te, Kang Chang Wei</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>GUSTO: Growing Up Towards Healthy Outcomes in Singapore</h4>
                                <p>Chong Yap Seng, Peter Gluckman, Michael Meaney, Johan Gunnar Eriksson</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Anti-viral and anti-bacterial coating inspired by dragonfly wings</h4>
                                <p>Yugen Zhang, Guangshun Yi, Jinquan Wang</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>M.A.T.A.R.: Multi-purpose All-Terrain Autonomous Robots</h4>
                                <p>Teneggi, Pauline Yeo, Stephanie Blanchard, Ranjani Nellnore, Julienne Cometa, Sylvia Gan, Nurul Rozaini, Christopher Quek, Venky Srirangam, Suman Sarma; Poh Huay Mei, Sandro Lezhava, Karen Lee, Masa Inoue, Jenefer Alam, Alex Matter</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Respiree</h4>
                                <p>Gurpreet Singh, Thanawin Trakoolwilaiwan, Gabriel Wu</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>CoVsurver: Virus surveillance platform</h4>
                                <p>Sebastian Maurer-Stroh, Raphael Lee Tze Chuen</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Fortitude Kit</h4>
                                <p>Sebastian Maurer-Stroh, Masafumi Inoue, Timothy Barkham (TTSH), Sidney Yee, Weng Ruifen, Wu Zheng'An Daniel, Anisah D/O Mohamed Khalid Shah</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>WGS analysis of multi-ethnic Asian populations</h4>
                                <p>Andreas Wilm, Chaolong Wang, Chiea Chuen Khor, Chih Chuan Shih, Claire Bellis, Clarabelle Bitong Lin, Degang Wu, Huck Hui Ng, Jia Nee Foo, Jianjun Liu, Jinzhuang Dou, Neerja Karnani, Nicolas Bertin, Patrick Tan, Roger S.Y. Foo, Wendy Wei Jia Soon, Xiaoran Chai, Sonia Davila (PRISM), Ching-Yu Cheng (SERI), Tin Aung (SERI), Tien Yin Wong (SERI), Khai Pang Leong (TTSH), Liuh Ling Goh (TTSH), Asim Shabbir (NUHS), Eng-King Tan (NNI), William Ying Khee Hwang (SGH), Shanshan Cheng (Huazhong University of Science and Technology), Li Bao (Huazhong University of Science and Technology), Michael DeGiorgio (Florida Atlantic University), Angela Moh (KTPH), Arthur Mark Richards (NUHCS), Carolyn Su Ping Lam (NUHCS) Meng, Mohaime Bin Mohahidin, Rick Yeo Chee Keong, Thaddie Natalaray, Ooi Yau Yen, Victor Quek Yen Sen, Keegan Lau, Winnie Ng, Wu Ying Ying</p>
                                <p>Andreas Wilm, Chaolong Wang, Chiea Chuen Khor, Chih Chuan Shih, Claire Bellis, Clarabelle Bitong Lin, Degang Wu, Huck Hui Ng, Jia Nee Foo, Jianjun Liu, Jinzhuang Dou, Neerja Karnani, Nicolas Bertin, Patrick Tan, Roger S.Y. Foo, Wendy Wei Jia Soon, Xiaoran Chai, Sonia Davila (PRISM), Ching-Yu Cheng (SERI), Tin Aung (SERI), Tien Yin Wong (SERI), Khai Pang Leong (TTSH), Liuh Ling Goh (TTSH), Asim Shabbir (NUHS), Eng-King Tan (NNI), William Ying Khee Hwang (SGH), Shanshan Cheng (Huazhong University of Science and Technology), Li Bao (Huazhong University of Science and Technology), Michael DeGiorgio (Florida Atlantic University), Angela Moh (KTPH), Arthur Mark Richards (NUHCS), Carolyn Su Ping Lam (NUHCS) Meng, Mohaime Bin Mohahidin, Rick Yeo Chee Keong, Thaddie Natalaray, Ooi Yau Yen, Victor Quek Yen Sen, Keegan Lau, Winnie Ng, Wu Ying Ying</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Resolute2.0 Kit</h4>
                                <p>DxD Hub: Sidney Yee, Weng Ruifen, Wu Zheng’An Daniel, Lin Youbin, Anisah D/O Mohamed Khalid Shah, Zul Fazreen Bin Adam Isa, Qu Zhengzhong James; DSO: Ayi Teck Choon, Chew Seok Wei, Janet, Lau Sok Kiang, Leong Kok Mun, Lim Jiali, Lim Xiao Fang, Low Hwee Teng, Neo Pei Shan Jacqueline, Ng Sock Hoon, Ting Peijun, Wong Pui San</p>
                                <p>DxD Hub: Sidney Yee, Weng Ruifen, Wu Zheng’An Daniel, Lin Youbin, Anisah D/O Mohamed Khalid Shah, Zul Fazreen Bin Adam Isa, Qu Zhengzhong James; DSO: Ayi Teck Choon, Chew Seok Wei, Janet, Lau Sok Kiang, Leong Kok Mun, Lim Jiali, Lim Xiao Fang, Low Hwee Teng, Neo Pei Shan Jacqueline, Ng Sock Hoon, Ting Peijun, Wong Pui San</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Rapid Automated Volume Enhancer (RAVE)</h4>
                                <p>Sidney Yee, Weng Ruifen, Qu Zhengzhong James, Wu Zheng'An Daniel, Anisah D/O Mohamed Khalid Shah, Ooi Yau Yen, Wang Qi Hong, Tey Kah King, Lim Pei Xian, Ham Yean How, and other contributors from ARTC, SIMTech, NMC, and IMRE</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Reusable face masks developed in partnership with Ramatex</h4>
                                <p>David Low, Stephen Wong Chee Khuen, Chng Shuyun, Lok Boon Keng, Jonathan Goh, Yan Wenjin, Wu Shiling, May Win Naing, Xie Hong, Ng Shu Pei, Ang Wei Ting, Qian Min, Goh Jwee How Kelvin, Nurul Ain Mohamed Ibrahim, Chew Youxiang, Lai Foo Khuen Steve, Tan Yeow Yau Wei Yun, Alberto Hendrawan Adiwahono, Ng Kam Pheng, Saurab Verma, Syed Zeeshan Ahmed Mukhtar, Zhang Kun, Lawrence Chen Tai Pang, Tan Chong Boon, Chen Yuda, Wan Kong Wah, Wang Jiangang, Li Jun, Ranier Yap Enhao, Tran Anh Dung, Luong Trung Tuan, Cheng Wee Kiang (HTX), Lee Guoming (HTX), Ong Ka Hing (HTX), Daniel Toh (SPF)</p>
                                <p>David Low, Stephen Wong Chee Khuen, Chng Shuyun, Lok Boon Keng, Jonathan Goh, Yan Wenjin, Wu Shiling, May Win Naing, Xie Hong, Ng Shu Pei, Ang Wei Ting, Qian Min, Goh Jwee How Kelvin, Nurul Ain Mohamed Ibrahim, Chew Youxiang, Lai Foo Khuen Steve, Tan Yeow Yau Wei Yun, Alberto Hendrawan Adiwahono, Ng Kam Pheng, Saurab Verma, Syed Zeeshan Ahmed Mukhtar, Zhang Kun, Lawrence Chen Tai Pang, Tan Chong Boon, Chen Yuda, Wan Kong Wah, Wang Jiangang, Li Jun, Ranier Yap Enhao, Tran Anh Dung, Luong Trung Tuan, Cheng Wee Kiang (HTX), Lee Guoming (HTX), Ong Ka Hing (HTX), Daniel Toh (SPF)</p>
                            </div>
                        </div>
                    </div>
                    <div class="item-wrapper">
                        <div class="item">
                            <div class="special-content-block">
                                <h4>Digital emotions and sentiment analysis</h4>
                                <p>Yang Yinping, Raj Kumar Gupta, Nur Atiqah Othman, Prasanta Bhattacharya, Ramanathan Subramanian, Lu Zhi Hui, Praveena Satkunarajah, Ivan Hoe, Francis Tan, Wan Kum Seong, Jason Yap, Saw Siew Lin, Faith Tng, Berlinda Zhang, Jazy Zhou, Wong Chit Kit, Therese Quieta, Tuan Le Mau, Brandon Loh Siyuan, Cui Mengyang, Zhang Mila, Ajay Vishwanath, Vuong Dao Nghe, Paul Edward Cain, Gangeshwar Krishnamurthy, Chitra Panchapakesan, Oh Hui Si, Aravind Raamkumar, Isabel Chew, Nancy Chen, Aw Ai Ti, Wu Kui, Huang Dongyan, Andreea I. Niculescu, Chong Tze Yuang, Rafahel E. Banchs, Sunil Sivadas, Wang Lei, Ding Wan, Kuruvachan Kalluvelil George, You Changhuai, Leng Yi Ren, Yeo Kheng Hui, Nabilah Binte Md Johan, Wang Xi, Tran Huy Dat, Luong Trung Tuan, Kukanov Ivan, Stefan Winkler, Zhang Le, Peng Songyou, Khaja Wasif Mohiuddin, Ramanathan Subramanian, Roland Zimmermann</p>
                                <p>Yang Yinping, Raj Kumar Gupta, Nur Atiqah Othman, Prasanta Bhattacharya, Ramanathan Subramanian, Lu Zhi Hui, Praveena Satkunarajah, Ivan Hoe, Francis Tan, Wan Kum Seong, Jason Yap, Saw Siew Lin, Faith Tng, Berlinda Zhang, Jazy Zhou, Wong Chit Kit, Therese Quieta, Tuan Le Mau, Brandon Loh Siyuan, Cui Mengyang, Zhang Mila, Ajay Vishwanath, Vuong Dao Nghe, Paul Edward Cain, Gangeshwar Krishnamurthy, Chitra Panchapakesan, Oh Hui Si, Aravind Raamkumar, Isabel Chew, Nancy Chen, Aw Ai Ti, Wu Kui, Huang Dongyan, Andreea I. Niculescu, Chong Tze Yuang, Rafahel E. Banchs, Sunil Sivadas, Wang Lei, Ding Wan, Kuruvachan Kalluvelil George, You Changhuai, Leng Yi Ren, Yeo Kheng Hui, Nabilah Binte Md Johan, Wang Xi, Tran Huy Dat, Luong Trung Tuan, Kukanov Ivan, Stefan Winkler, Zhang Le, Peng Songyou, Khaja Wasif Mohiuddin, Ramanathan Subramanian, Roland Zimmermann</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-us-block">
            <div class="container">
                <div class="heading-block">
                    <h1>Get in touch with A<span>*</span>STAR</h1>
                </div>
                <div class="contact-us-subblock">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="left-block">
                                <iframe src="https://www.onemap.sg/amm/amm.html?mapStyle=Default&amp;zoomLevel=17&amp;marker=latLng:1.299150165,103.7875812!iwt:null!colour:red&amp;popupWidth=200" height="300" width="100%" scrolling="no" frameborder="0" allowfullscreen="allowfullscreen" style="margin-top:20px;"></iframe>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="right-block">
                                <div class="address-block">
                                    <h5>Address</h5>
                                    <p>1 Fusionopolis Way, #20-10 Connexis North Tower Singapore 138632</p>
                                </div>
                                <div class="contact-details-block">
                                    <h5>Contact Us</h5>
                                    <ul>
                                        <li>
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                            <a href="mailto:contact@a-star.edu.sg">contact@a-star.edu.sg</a>
                                        </li>
                                        <li>
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <a href="tel:(65)68266111">(65) 6826 6111</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    @stack('script')
    @include('layouts.front.includes.alerts')
</body>
</html>
