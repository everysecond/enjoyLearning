<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title></title>

    <!-- H+ -->
    <link href="render/hplus/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="render/hplus/css/bootstrap-table.min.css" rel="stylesheet">
    <link href="render/hplus/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="render/hplus/css/animate.css" rel="stylesheet">
    <link href="render/hplus/css/style.css?v=4.1.0" rel="stylesheet">
    <style type="text/css">
        .nav {
            font-size: 13px;
        }

        .tips-red {
            border-radius: 20px;
            border: 1px solid #fd6262;
            background-color: #fd6262;
            color: white;
        }

        .nav .arrow {
            float: right;
        }

        .navbar-minimalize {
            position: absolute;
            top: 0;
            left: 0;
            width: 38px;
            height: 40px;
            line-height: 30px;
            margin: 0 0 0 0;
            border-radius: 0px;
        }

        .content-tabs .roll-left {
            left: 38px;
        }

        nav.page-tabs {
            margin-left: 78px;
        }

        #content-main {
            height: calc(100% - 42px);
        }
    </style>
</head>
<?php $roleList=['sales_confirm'];?>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header" style=" padding:0 0 5px 0;">
                    <div class="dropdown profile-element" style="background-color: #e2003b;padding: 12px 44px">
                        <a href="/?token={{request('token')}}">
                            <img alt="" src="/img/profile_small.jpg" style="width: 120px">
                        </a>
                    </div>
                    <div class="logo-element"><img alt="" src="/img/user.png">
                    </div>
                </li>
                <li class="">
                    <a href="#" style="padding:10px 28px;">
                        <i class="fa fa-dashboard"></i> <span class="nav-label">
                            <span class="text-muted text-xs block" style="float: right">
                           <strong class="font-bold">
                                   @if(Session::has('user'))
                                   {{ Session::get('user')->LoginId }}
                               @endif
                               </strong><b class="caret"></b>
                            </span>
                        </span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a target="_blank" href="{{env('JOB_URL', 'http://www.51idc.cn')}}/crm">进入CRM系统</a>
                        </li>
                        <li><a target="_blank" href="{{env('JOB_URL', 'http://www.51idc.cn')}}/anchres">进入资源系统</a>
                        </li>
                        <li><a target="_blank" href="{{env('ITSM_URL', 'https://testitsm.anchnet.com')}}">进入ITSM系统</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="javascript:return;" class="logout">注销</a>
                        </li>
                    </ul>
                </li>
                @if(in_array("sales_confirm",$roleList)||in_array("finance_confirm",$roleList)
                ||in_array("operate_role",$roleList)||in_array("business_confirm",$roleList)
                ||in_array("company_confirm",$roleList))
                    <li>
                        <a class="J_menuItem" href="rebate/accounts/index" menuname="VIP账户列表">
                            <i class="fa fa-archive"></i><span>VIP账户列表</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-clipboard"></i> <span class="nav-label">VIP优惠管理</span><span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                @if(in_array("sales_confirm",$roleList))
                                    <a class="J_menuItem" href="rebate/applies/index/sale" menuname="销售审核">销售审核列表</a>
                                @endif
                                @if(in_array("operate_role",$roleList))
                                    <a class="J_menuItem" href="rebate/applies/index/toProductConfirm" menuname="运营审核">运营审核列表</a>
                                @endif
                                @if(in_array("sales_manager",$roleList))
                                    <a class="J_menuItem" href="rebate/applies/index/toManageConfirm" menuname="主管审核">主管审核列表</a>
                                @endif
                                @if(in_array("director_confirm",$roleList))
                                    <a class="J_menuItem" href="rebate/applies/index/toDirectorConfirm" menuname="总监审核">总监审核列表</a>
                                @endif
                                @if(in_array("business_confirm",$roleList))
                                    <a class="J_menuItem" href="rebate/applies/index/toBusinessConfirm" menuname="商务审核">商务审核列表</a>
                                @endif
                                @if(in_array("finance_confirm",$roleList))
                                    <a class="J_menuItem" href="rebate/applies/index/toFinanceConfirm" menuname="CFO审核">CFO审核列表</a>
                                @endif
                                @if(in_array("ceo_confirm",$roleList))
                                    <a class="J_menuItem" href="rebate/applies/index/toCEOConfirm" menuname="CEO审核">CEO审核列表</a>
                                @endif
                                @if(in_array("company_confirm",$roleList))
                                    <a class="J_menuItem" href="rebate/applies/index/toBossConfirm" menuname="BOSS审核">BOSS审核列表</a>
                                @endif
                                <a class="J_menuItem" href="rebate/applies/index/all" menuname="BOSS审核">全部审核列表</a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(in_array("sales_confirm",$roleList)||in_array("finance_confirm",$roleList)
                ||in_array("business_confirm",$roleList)||in_array("company_confirm",$roleList))
                    <li>
                        <a href="#"><i class="fa fa-list"></i> <span class="nav-label">VIP优惠支付管理</span><span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                @if(in_array("sales_confirm",$roleList))
                                    <a class="J_menuItem" href="rebate/pay_applies/index/sale" menuname="销售审核">销售审核列表</a>
                                @endif
                                @if(in_array("business_confirm",$roleList))
                                    <a class="J_menuItem" href="rebate/pay_applies/index/toBusinessConfirm" menuname="商务审核列表">商务审核列表</a>
                                @endif
                                @if(in_array("finance_confirm",$roleList))
                                    <a class="J_menuItem" href="rebate/pay_applies/index/toFinanceConfirm" menuname="财务审核列表">财务审核列表</a>
                                    <a class="J_menuItem" href="rebate/pay_applies/index/toPayConfirm" menuname="待付款审核列表">待付款审核列表</a>
                                @endif
                                <a class="J_menuItem" href="rebate/pay_applies/index/all" menuname="全部审核列表">全部审核列表</a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li>
                    <a href="#"><i class="fa fa-user"></i> <span class="nav-label">个人信息管理</span><span
                                class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a class="J_menuItem"
                               href="{{env('JOB_URL', 'http://www.51idc.cn')}}/crm/user/userinfoManage.html"
                               menuname="个人信息修改">个人信息管理</a></li>
                        <li><a class="J_menuItem"
                               href="{{env('JOB_URL', 'http://www.51idc.cn')}}/crm/user/passwordManage.html"
                               menuname="修改密码">修改密码</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row content-tabs">
            <a class="navbar-minimalize minimalize-styl-2 btn" href="#"><i style="color:#8F95A2" class="fa fa-bars"></i>
            </a>
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active J_menuTab" data-id="dashboard/staff">Dashboard</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">其他操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a></li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a></li>
                    <li><a target="_blank" href="{{env('JOB_URL', 'http://www.51idc.cn')}}/crm/">进入CRM系统</a>
                    </li>
                    <li><a target="_blank" href="{{env('JOB_URL', 'http://www.51idc.cn')}}/anchres/">进入资源系统</a>
                    </li>
                    <li><a target="_blank" href="{{env('ITSM_URL', 'https://testitsm.anchnet.com')}}">进入ITSM系统</a>
                    </li>
                </ul>
            </div>
            <a href="javascript:return;" class="roll-nav roll-right J_tabExit logout"><i class="fa fa fa-sign-out"></i>
                注销</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe-dashboard/staff" width="100%" height="100%" src="dashboard/staff"
                    frameborder="0" data-id="dashboard/staff" seamless
                    onload="iframeOnload('dashboard/staff')"></iframe>
        </div>
    </div>
    <!--右侧部分结束-->
</div>

<!-- H+ -->
<script type="text/javascript" src="/js/bgmusic.js"></script>
<script type="text/javascript" src="/render/hplus/js/jquery.min.js"></script>
<script type="text/javascript" src="/render/hplus/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/render/hplus/js/bootstrap-table.min.js"></script>
<script type="text/javascript" src="/render/hplus/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script type="text/javascript" src="/render/hplus/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/render/hplus/js/plugins/layer/layer.min.js"></script>
<script type="text/javascript" src="/render/hplus/js/hplus.js"></script>
<script type="text/javascript" src="/render/hplus/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="/render/hplus/js/contabs.js"></script>
<script type="text/javascript" src="/render/hplus/js/plugins/pace/pace.min.js"></script>
<script type="text/javascript">
    var _topWin = window;
    while (_topWin != _topWin.parent.window) {
        _topWin = _topWin.parent.window;
    }
    if (window != _topWin) _topWin.document.location.href = location.href;

    window.onbeforeunload = function () {
        // return '提醒：刷新或关闭页面会丢失所有Tab';
    };

    $(".logout").click(function () {
        layer.confirm("确认退出？", function () {
            location.href = "logout";
        });
    })

    //获取当前登录用户头像
    function getMyHeadImage() {
        $.ajax({
            type: "GET",
            url: "/support/getMyHeadImage",
            success: function (data) {
                if (data) {
                    $("#headImage").attr('src', data);
                    $("#headImage").attr('class', 'img-circle');
                    $("#headImage").attr('style', 'width:64px;height: 64px');
                }
            }
        })
    }
    getMyHeadImage();
    $(".J_menuTab").dblclick(function () {
    });
    $(".J_menuTab").dblclick(function () {
    });
</script>
</body>
</html>
