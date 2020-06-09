<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Dashboard</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css">
        
    </head>
    <body>
        <div class="wrap-container" id="app">
        <div class="container">
        <div class="header">
            <div class="header-left">
                <ul>
                    <li>
                        <div class="header-img">
                            <img src="/images/logo.png" alt="logo">
                        </div>
                    </li>
                    <li>
                        <div class="header-logo-text">
                            <p class="">lnternia</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="header-center">
                <ul>
                    <li>Calenda</li>
                    <li>Statistic</li>
                    <li>Employee</li>
                    <li>Client</li>
                    <li>Equipment</li>
                </ul>
            </div>
            <div class="header-right">
                <ul>
                    <li>
                        <i class="far fa-bell" style="color:black;"></i>
                    </li>
                    <li>
                        <i class="fas fa-bell"></i>
                    </li>
                    <li>
                        <div class="profile-image">
                            <img src="/images/icon.png" alt="logo">
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="body">
            <div class="body-top">
                <p>employee</p>
                <button>add employee</button>
            </div>
            <div class="body-mid">
                <div class="nav-side">
                    <div class="nav-side-bar">
                        <div class="nav-side-bar-image">
                            <div class="side-img">
                                <img src="/images/logo.png" alt="logo">
                            </div>
                            <div class="side-text">
                                <p class="">All Employee</p>
                            </div>
                        </div>
                        <div class="nav-side-bar-notice">
                            <p class="">Project</p>
                                <ul>
                                    <li>
                                        <div class="side-icon">
                                           <p> DG </p>
                                        </div>
                                        <div class="side-name">
                                            <p>Daniel Godwin</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="side-icon">
                                           <p> DG </p>
                                        </div>
                                        <div class="side-name">
                                            <p>Daniel Godwin</p>
                                        </div>
                                    </li>
                                </ul>
                        </div>
                    </div>
                </div>
                <div class="main-content">
                    <div class="main-content-table">
                        <table>
                            <thead>
                                <tr>
                                    <th><p>0</p></th>
                                    <th><p>Image</p></th>
                                    <th><p>EMPLOYEE</p></th>
                                    <th><p>SALARY</p></th>
                                    <th><p>STATUS</p></th>
                                    <th><p>MANAGE</p></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                        <td>
                                            0
                                        </td>
                                        <td>
                                            <div class="main-content-image">
                                                    <img src="/images/icon.png" alt="logo">
                                            </div>
                                        </td>
                                        <td>
                                            <p> Godwin Daniel </p>
                                            <span>Electrical Engineer</span>
                                        </td>
                                        <td>
                                            <p> 4,500 Naira </p>
                                            <span>Full Time</span>
                                        </td>
                                        <td>
                                            <p>test period</p>
                                            <span>2 Months</span>
                                        </td>
                                        <td>
                                        <p><span>E</span>|<span></span>D</p>
                                        
                                        </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </body>
    <script src="{{asset('js/app.js')}}"></script>
</html>
