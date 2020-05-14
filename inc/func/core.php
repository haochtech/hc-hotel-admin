<?php
defined('IN_IA') or exit ('Access Denied');
class Core extends WeModuleSite
{

    public function getMainMenu()
    {
        global $_W, $_GPC;
        $type=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']),array('open_member','is_score'));
        $do = $_GPC['do'];
        $navemenu = array();
        $cur_color = ' style="color:#d9534f;" '; 
          if ($_W['role'] == 'operator') {
            $navemenu[8] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=hotel&m=zh_jdgjb" class="panel-title wytitle" id="yframe-8"><icon style="color:#8d8d8d;" class="fa fa-cart-plus"></icon>  酒店管理</a>',
                'items' => array(
                    0 => $this->createMainMenu('门店列表', $do, 'hotel','')
                )
            );}elseif($_W['isfounder'] || $_W['role'] == 'manager') {
        $navemenu[14] = array(

            'title' => '<a href="index.php?c=site&a=entry&op=display&do=ptdata&m=zh_jdgjb" class="panel-title wytitle" id="yframe-14"><icon style="color:#8d8d8d;" class="fa fa-newspaper-o"></icon>  数据概况</a>',
            'items' => array(
               0 => $this->createMainMenu('数据展示 ', $do, 'ptdata', ''),
               1 => $this->createMainMenu('账号管理 ', $do, 'account', ''),
               2 => $this->createMainMenu('账号添加 ', $do, 'addaccount', ''),
               )
            );
        $navemenu[8] = array(
            'title' => '<a href="index.php?c=site&a=entry&op=display&do=hotel&m=zh_jdgjb" class="panel-title wytitle" id="yframe-8"><icon style="color:#8d8d8d;" class="fa fa-cart-plus"></icon>  酒店管理</a>',
            'items' => array(
                 0 => $this->createMainMenu('酒店列表 ', $do, 'hotel', ''),
                 1=> $this->createMainMenu('添加酒店', $do, 'addhotel', ''),
                 2=> $this->createMainMenu('入驻审核', $do, 'auditorhotel', ''),
        
            )
        );
        $navemenu[17] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=nav&m=zh_jdgjb" class="panel-title wytitle" id="yframe-17"><icon style="color:#8d8d8d;" class="fa fa-compass"></icon>导航管理</a>',
                'items' => array(
                     0 => $this->createMainMenu('导航管理 ', $do, 'nav', ''),
                     1=> $this->createMainMenu('添加导航', $do, 'addnav', ''),
                    
                   
                )
            );
          $navemenu[2] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=ad&m=zh_jdgjb" class="panel-title wytitle" id="yframe-2"><icon style="color:#8d8d8d;" class="fa fa-gift"></icon>广告管理</a>',
                'items' => array(
                     0 => $this->createMainMenu('广告管理 ', $do, 'ad', ''),
                     1=> $this->createMainMenu('添加广告', $do, 'addad', ''),
                )
            );
         $navemenu[18] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=order&m=zh_jdgjb" class="panel-title wytitle" id="yframe-18"><icon style="color:#8d8d8d;" class="fa fa-server"></icon>订单管理</a>',
                'items' => array(
                     0 => $this->createMainMenu('订单管理 ', $do, 'order', ''),
                    
                    
                   
                )
            );
       $navemenu[6] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=coupon&m=zh_jdgjb" class="panel-title wytitle" id="yframe-6"><icon style="color:#8d8d8d;" class="fa fa-bars"></icon>优惠券管理</a>',
                'items' => array(
                     0 => $this->createMainMenu('优惠券管理 ', $do, 'coupon', ''),
                     1 => $this->createMainMenu('添加优惠券 ', $do, 'addcoupon', ''),
                )
            );   
    if($type['is_score']==1){          
        $navemenu[20] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=jftype&m=zh_jdgjb" class="panel-title wytitle" id="yframe-20"><icon style="color:#8d8d8d;" class="fa fa-star-half-o"></icon>  积分商城</a>',
                'items' => array(
                    0 => $this->createMainMenu('商品列表', $do, 'jfgoods', ''),
                    1 => $this->createMainMenu('商品分类', $do, 'jftype', ''),
                    2 => $this->createMainMenu('积分设置', $do, 'score', ''),
                    3 => $this->createMainMenu('兑换列表', $do, 'dhlist', ''),
                )
            );
        }
           
     if($type['open_member']==1){                      
       $navemenu[1] = array(
            'title' => '<a href="index.php?c=site&a=entry&op=display&do=memberlevel&m=zh_jdgjb" class="panel-title wytitle" id="yframe-1"><icon style="color:#8d8d8d;" class="fa fa-money"></icon>  会员等级</a>',
            'items' => array(
                 0 => $this->createMainMenu('等级管理 ', $do, 'memberlevel', ''),
                 1=> $this->createMainMenu('添加等级', $do, 'addmemberlevel', ''),
                 2=> $this->createMainMenu('会员列表', $do, 'member', ''),
            )
        );
   }
         $navemenu[9] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=fxlist&m=zh_jdgjb" class="panel-title wytitle" id="yframe-9"><icon style="color:#8d8d8d;" class="fa fa-users"></icon>  分销系统</a>',
                'items' => array(
                    0 => $this->createMainMenu('分销商管理', $do, 'fxlist', ''),
                    1 => $this->createMainMenu('分销设置', $do, 'fxset', ''),
                    2 => $this->createMainMenu('提现管理', $do, 'fxtx', ''),
                    //3 => $this->createMainMenu('提现设置', $do, 'fxtxsz', ''),
                )
            );

        
     
          /* $navemenu[10] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=sponsor&m=zh_jdgjb" class="panel-title wytitle" id="yframe-10"><icon style="color:#8d8d8d;" class="fa fa-users"></icon> 主办方管理</a>',
                'items' => array(
                     0 => $this->createMainMenu('主办方管理 ', $do, 'sponsor', ''),
                     1=> $this->createMainMenu('认证管理 ', $do, 'attestation', ''),
                     2=> $this->createMainMenu('认证设置 ', $do, 'rzcheck', ''),
                    
                )
            );*/

          $navemenu[3] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=txlist&m=zh_jdgjb" class="panel-title wytitle" id="yframe-3"><icon style="color:#8d8d8d;" class="fa fa-money"></icon>  提现管理</a>',
                'items' => array(
                     0 => $this->createMainMenu('提现列表 ', $do, 'txlist', ''),
                     1 => $this->createMainMenu('提现设置 ', $do, 'txsz', ''),
                     2 => $this->createMainMenu('充值优惠 ', $do, 'chongzhi', ''),
                     3 => $this->createMainMenu('充值记录 ', $do, 'czjl', ''),
                )
            );
           
            $navemenu[4] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=user2&m=zh_jdgjb" class="panel-title wytitle" id="yframe-4"><icon style="color:#8d8d8d;" class="fa fa-user"></icon>  用户管理</a>',
                'items' => array(
                     0 => $this->createMainMenu('用户列表 ', $do, 'user2', ''),
                )
            );         
            $navemenu[5] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=settings&m=zh_jdgjb" class="panel-title wytitle" id="yframe-5"><icon style="color:#8d8d8d;" class="fa fa-cog"></icon>  系统设置</a>',
                'items' => array(
                    0 => $this->createMainMenu('基本信息 ', $do, 'settings', ''),
                    1 => $this->createMainMenu('小程序配置', $do, 'peiz', ''),
                    2 => $this->createMainMenu('支付配置', $do, 'pay', ''), 
                    // 3 => $this->createMainMenu('积分设置', $do, 'score', ''),
                    4 => $this->createMainMenu('短信配置', $do, 'sms', ''),
                    5 => $this->createMainMenu('模板消息配置', $do, 'news', ''),                  
                    //6 => $this->createMainMenu('提现设置', $do, 'txset', ''),
                    7 => $this->createMainMenu('版权设置', $do, 'copyright', ''),                   
                    
                )
            );
          }
     
        return $navemenu;
    }



      public function getMainMenu2()
    {
        global $_W, $_GPC;
        $do = $_GPC['do'];
        $navemenu = array();
        $cur_color = ' style="color:#d9534f;" '; 
        $navemenu[14] = array(
            'title' => '<a href="index.php?c=site&a=entry&op=display&do=statistics&m=zh_jdgjb" class="panel-title wytitle" id="yframe-14"><icon style="color:#8d8d8d;" class="fa fa-newspaper-o"></icon>  门店信息</a>',
            'items' => array(
                0 => $this->createMainMenu('首页概览', $do, 'statistics', ''),
               1 => $this->createMainMenu('门店信息 ', $do, 'storeinfo', ''),
               )
            );
        $navemenu[8] = array(
            'title' => '<a href="index.php?c=site&a=entry&op=display&do=room&m=zh_jdgjb" class="panel-title wytitle" id="yframe-8"><icon style="color:#8d8d8d;" class="fa fa-cart-plus"></icon>房型管理</a>',
            'items' => array(
                
                 3 => $this->createMainMenu('房型管理 ', $do, 'room', ''),
                 4 => $this->createMainMenu('房型添加 ', $do, 'addroom', ''),
        
            )
        );
         $navemenu[12] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=inorder&m=zh_jdgjb" class="panel-title wytitle" id="yframe-12"><icon style="color:#8d8d8d;" class="fa fa-cog"></icon> 订单管理</a>',
                'items' => array(
                     2 => $this->createMainMenu('订单管理 ', $do, 'inorder', ''),
                    
                )
            );
        $navemenu[17] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=number&m=zh_jdgjb" class="panel-title wytitle" id="yframe-17"><icon style="color:#8d8d8d;" class="fa fa-compass"></icon>酒店维护</a>',
                'items' => array(
                     2 => $this->createMainMenu('房量维护 ', $do, 'number', ''),
                     3 => $this->createMainMenu('房价维护 ', $do, 'price', ''),
                    
                   
                )
            );
         $navemenu[18] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=incoupon&m=zh_jdgjb" class="panel-title wytitle" id="yframe-18"><icon style="color:#8d8d8d;" class="fa fa-bars"></icon>优惠券管理</a>',
                'items' => array(
                     0 => $this->createMainMenu('优惠券管理 ', $do, 'incoupon', ''),
                    1 => $this->createMainMenu('优惠券添加 ', $do, 'inaddcoupon', ''),
                    
                    
                   
                )
            );
         $navemenu[10] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=assess&m=zh_jdgjb" class="panel-title wytitle" id="yframe-10"><icon style="color:#8d8d8d;" class="fa fa-user"></icon> 评论管理</a>',
                'items' => array(
                     0 => $this->createMainMenu('评论管理 ', $do, 'assess', ''),
                    
                    
                )
                ); 
       $navemenu[6] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=txdetails&m=zh_jdgjb" class="panel-title wytitle" id="yframe-6"><icon style="color:#8d8d8d;" class="fa fa-bars"></icon>提现管理</a>',
                'items' => array(
                    0 => $this->createMainMenu('提现明细 ', $do, 'txdetails', ''),
                    1 => $this->createMainMenu('申请提现 ', $do, 'txapply', '')
                )
            );   
                           
           
            $navemenu[4] = array(
                'title' => '<a href="index.php?c=site&a=entry&op=display&do=print&m=zh_jdgjb" class="panel-title wytitle" id="yframe-4"><icon style="color:#8d8d8d;" class="fa fa-cog"></icon>  消息设置</a>',
                'items' => array(
                       0 => $this->createMainMenu('打印提醒 ', $do, 'print', ''),
                       1 => $this->createMainMenu('短信提醒 ', $do, 'notice', ''),
                )
            );         
      
     
        return $navemenu;
    }


     public function getNaveMenu($storeid='', $action='',$uid='')
    {
        global $_W, $_GPC;
        $account=pdo_get('zh_jdgjb_account',array('storeid'=>$storeid,'uid'=>$uid));
        $do = $_GPC['do'];
        $navemenu = array();
        $cur_color = '#8d8d8d';
          if($account['role']==1){
        $navemenu[0] = array(
             'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlstatistics&m=zh_jdgjb" class="panel-title wytitle" id="yframe-0"><icon style="color:#8d8d8d;" class="fa fa-newspaper-o"></icon>  门店信息</a>',
            'items' => array(
                0 => $this->createSubMenu('首页概览', $do, 'dlstatistics', 'fa-angle-right', $cur_color, $storeid),
                1 => $this->createSubMenu('门店信息 ', $do, 'dlstoreinfo', 'fa-angle-right', $cur_color, $storeid),
               
            ),
            'icon' => 'fa fa-user-md'
        );
        $cur_color = '#8d8d8d';
        $navemenu[1] = array(
            'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlroom&m=zh_jdgjb" class="panel-title wytitle" id="yframe-1"><icon style="color:#8d8d8d;" class="fa fa-cart-plus"></icon>房型管理</a>',
           
            'items' => array(
                0 => $this->createSubMenu('房型管理 ', $do, 'dlroom', $cur_color, $storeid),
                1 => $this->createSubMenu('房型添加 ', $do, 'dladdroom', 'fa-angle-right', $cur_color, $storeid),
              
            )
           
        );
        $cur_color = '#8d8d8d';
        $navemenu[2] = array(
           'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlinorder&m=zh_jdgjb" class="panel-title wytitle" id="yframe-2"><icon style="color:#8d8d8d;" class="fa fa-cog"></icon> 订单管理</a>',
            'items' => array(
                0 => $this->createSubMenu('订单管理 ', $do, 'dlinorder', 'fa-angle-right', $cur_color, $storeid),
               
            )
        );

        $cur_color = '#8d8d8d';

            $navemenu[3] = array(
               'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlnumber&m=zh_jdgjb" class="panel-title wytitle" id="yframe-3"><icon style="color:#8d8d8d;" class="fa fa-compass"></icon>酒店维护</a>',
                'items' => array(
                    0 => $this->createSubMenu('房量维护 ', $do, 'dlnumber', $cur_color, $storeid),
                    1 => $this->createSubMenu('房价维护 ', $do, 'dlprice', 'fa-angle-right', $cur_color, $storeid),
                ),
            );
   
        
        $cur_color = '#8d8d8d';
        $navemenu[4] = array(
           'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlincoupon&m=zh_jdgjb" class="panel-title wytitle" id="yframe-4"><icon style="color:#8d8d8d;" class="fa fa-bars"></icon>优惠券管理</a>',
            'items' => array(
                0 => $this->createSubMenu('优惠券管理 ', $do, 'dlincoupon', 'fa-angle-right', $cur_color, $storeid),
                1 => $this->createSubMenu('优惠券添加 ', $do, 'dlinaddcoupon', 'fa-angle-right', $cur_color, $storeid),
            )
        );

        $cur_color = '#8d8d8d';
        $navemenu[5] = array(
            'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlassess&m=zh_jdgjb" class="panel-title wytitle" id="yframe-5"><icon style="color:#8d8d8d;" class="fa fa-user"></icon> 评论管理</a>',
            'items' => array(
                0 => $this->createSubMenu('评论管理 ', $do, 'dlassess', 'fa-angle-right', $cur_color, $storeid),
            )
        );
         $navemenu[7] = array(
                'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dltxdetails&m=zh_jdgjb" class="panel-title wytitle" id="yframe-7"><icon style="color:#8d8d8d;" class="fa fa-bars"></icon>提现管理</a>',
                'items' => array(
                    0 => $this->createSubMenu('提现明细 ', $do, 'dltxdetails', ''),
                    1 => $this->createSubMenu('申请提现 ', $do, 'dltxapply', '')
                )
            );   
        $cur_color = '#8d8d8d';
        $navemenu[6] = array(
              'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlprint&m=zh_jdgjb" class="panel-title wytitle" id="yframe-6"><icon style="color:#8d8d8d;" class="fa fa-cog"></icon>  消息设置</a>',
            'items' => array(
                0 => $this->createSubMenu('打印提醒 ', $do, 'dlprint', 'fa-angle-right', $cur_color, $storeid),
                1 => $this->createSubMenu('短信提醒 ', $do, 'dlnotice', 'fa-angle-right', $cur_color, $storeid),
                
            )
        );
            $navemenu[14] = array(

            'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlaccount&m=zh_jdgjb" class="panel-title wytitle" id="yframe-14"><icon style="color:#8d8d8d;" class="fa fa-newspaper-o"></icon>  账号管理</a>',
            'items' => array(
        
               1 => $this->createSubMenu('账号管理 ', $do, 'dlaccount', ''),
               2 => $this->createSubMenu('账号添加 ', $do, 'dladdaccount', ''),
               )
            );

        }else{
        	$arr=explode(',',$account['authority']);
        	foreach ($arr as $key => $value) {
        		if( $value=='dlstatistics'){
        			$navemenu[0] = array(
        				'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlstatistics&m=zh_jdgjb" class="panel-title wytitle" id="yframe-0"><icon style="color:#8d8d8d;" class="fa fa-newspaper-o"></icon>  门店信息</a>',
        				'items' => array(
        					0 => $this->createSubMenu('首页概览', $do, 'dlstatistics', 'fa-angle-right', $cur_color, $storeid),
        					1 => $this->createSubMenu('门店信息 ', $do, 'dlstoreinfo', 'fa-angle-right', $cur_color, $storeid),

        					),
        				'icon' => 'fa fa-user-md'
        				);
        		}
        		if( $value=='dlroom'){
        			$navemenu[1] = array(
        				'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlroom&m=zh_jdgjb" class="panel-title wytitle" id="yframe-1"><icon style="color:#8d8d8d;" class="fa fa-cart-plus"></icon>房型管理</a>',
        				'items' => array(
        					0 => $this->createSubMenu('房型管理 ', $do, 'dlroom', $cur_color, $storeid),
        					1 => $this->createSubMenu('房型添加 ', $do, 'dladdroom', 'fa-angle-right', $cur_color, $storeid),

        					)

        				);
        		}
        		if( $value=='dlinorder'){
        			$navemenu[2] = array(
        				'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlinorder&m=zh_jdgjb" class="panel-title wytitle" id="yframe-2"><icon style="color:#8d8d8d;" class="fa fa-cog"></icon> 订单管理</a>',
        				'items' => array(
        					0 => $this->createSubMenu('订单管理 ', $do, 'dlinorder', 'fa-angle-right', $cur_color, $storeid),

        					)
        				);
        		}                  
        		if( $value=='dlnumber'){
        			$navemenu[3] = array(
        				'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlnumber&m=zh_jdgjb" class="panel-title wytitle" id="yframe-3"><icon style="color:#8d8d8d;" class="fa fa-compass"></icon>酒店维护</a>',
        				'items' => array(
        					0 => $this->createSubMenu('房量维护 ', $do, 'dlnumber', $cur_color, $storeid),
        					1 => $this->createSubMenu('房价维护 ', $do, 'dlprice', 'fa-angle-right', $cur_color, $storeid),
        					),
        				);
        		}  
        		if( $value=='dlincoupon'){
        			$navemenu[4] = array(
        				'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlincoupon&m=zh_jdgjb" class="panel-title wytitle" id="yframe-4"><icon style="color:#8d8d8d;" class="fa fa-bars"></icon>优惠券管理</a>',
        				'items' => array(
        					0 => $this->createSubMenu('优惠券管理 ', $do, 'dlincoupon', 'fa-angle-right', $cur_color, $storeid),
        					1 => $this->createSubMenu('优惠券添加 ', $do, 'dlinaddcoupon', 'fa-angle-right', $cur_color, $storeid),
        					)
        				);
        		}  
        		if( $value=='dlassess'){
        			$navemenu[5] = array(
        				'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlassess&m=zh_jdgjb" class="panel-title wytitle" id="yframe-5"><icon style="color:#8d8d8d;" class="fa fa-user"></icon> 评论管理</a>',
        				'items' => array(
        					0 => $this->createSubMenu('评论管理 ', $do, 'dlassess', 'fa-angle-right', $cur_color, $storeid),
        					)
        				);
        		}   
        		if( $value=='dltxdetails'){
        			$navemenu[7] = array(
        				'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dltxdetails&m=zh_jdgjb" class="panel-title wytitle" id="yframe-7"><icon style="color:#8d8d8d;" class="fa fa-bars"></icon>提现管理</a>',
        				'items' => array(
        					0 => $this->createSubMenu('提现明细 ', $do, 'dltxdetails', ''),
        					1 => $this->createSubMenu('申请提现 ', $do, 'dltxapply', '')
        					)
        				);  
        		}   
        		if( $value=='dlprint'){
        			$navemenu[6] = array(
        				'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlprint&m=zh_jdgjb" class="panel-title wytitle" id="yframe-6"><icon style="color:#8d8d8d;" class="fa fa-cog"></icon>  消息设置</a>',
        				'items' => array(
        					0 => $this->createSubMenu('打印提醒 ', $do, 'dlprint', 'fa-angle-right', $cur_color, $storeid),
        					1 => $this->createSubMenu('短信提醒 ', $do, 'dlnotice', 'fa-angle-right', $cur_color, $storeid),

        					)
        				);
        		}      
        		if( $value=='dlaccount'){
        		$navemenu[14] = array(

        			'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do=dlaccount&m=zh_jdgjb" class="panel-title wytitle" id="yframe-14"><icon style="color:#8d8d8d;" class="fa fa-newspaper-o"></icon>  账号管理</a>',
        			'items' => array(

        				1 => $this->createSubMenu('账号管理 ', $do, 'dlaccount', ''),
        				2 => $this->createSubMenu('账号添加 ', $do, 'dladdaccount', ''),
        				)
        			);
        	}  

        }

        //       if(!empty($arr1)){
        //         foreach($arr1 as $key=> $value) {
        //             if(strpos($value['url'],'dlstatistics')){
        //                 $nav='dlstatistics';
        //                 break;
        //             }
        //              if(strpos($value['url'],'dlstoreinfo')){
        //                 $nav='dlstoreinfo';
        //                 break;
        //             }
        //         }  
        //       // echo $nav;die;
        //     $navemenu[0] = array(
        //      'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do='.$nav.'&m=zh_jdgjb" class="panel-title wytitle" id="yframe-0"><icon style="color:#8d8d8d;" class="fa fa-newspaper-o"></icon>  门店信息</a>',
        //     'items' => $arr1,
        //     'icon' => 'fa fa-user-md',
        //      );
        // }
        //    if(!empty($arr2)){
        //       foreach($arr2 as $key=> $value) {
        //             if(strpos($value['url'],'dlroom')){
        //                 $nav='dlroom';
        //                 break;
        //             }
        //              if(strpos($value['url'],'dladdroom')){
        //                 $nav='dladdroom';
        //                 break;
        //             }
        //         }  
        //     $navemenu[1] = array(
        //      'title' => '<a href="zhjd.php?c=site&a=entry&op=display&do='.$nav.'&m=zh_jdgjb" class="panel-title wytitle" id="yframe-0"><icon style="color:#8d8d8d;" class="fa fa-newspaper-o"></icon>  房型管理</a>',
        //     'items' => $arr2,
        //     'icon' => 'fa fa-user-md',
        //      );
        // }

        }
        return $navemenu;
    }

    function createWebUrl2($do, $query = array()) {
        $query['do'] = $do;
        $query['m'] = strtolower($this->modulename);
        
        return $this->wurl('site/entry', $query);
    }

    function wurl($segment, $params = array()) {
      
        list($controller, $action, $do) = explode('/', $segment);
        $url = './zhjd.php?';
        if (!empty($controller)) {
            $url .= "c={$controller}&";
        }
        if (!empty($action)) {
            $url .= "a={$action}&";
        }
        if (!empty($do)) {
            $url .= "do={$do}&";
        }
        if (!empty($params)) {
            $queryString = http_build_query($params, '', '&');
            $url .= $queryString;
        }
        return $url;
    }

    function createCoverMenu($title, $method, $op, $icon = "fa-image", $color = '#d9534f')
    {
        global $_GPC, $_W;
        $cur_op = $_GPC['op'];
        $color = ' style="color:'.$color.';" ';
        return array('title' => $title, 'url' => $op != $cur_op ? $this->createWebUrl($method, array('op' => $op)) : '',
            'active' => $op == $cur_op ? ' active' : '',
            'append' => array(
                'title' => '<i class="fa fa-angle-right"></i>',
                )
            );
    }

    function createMainMenu($title, $do, $method, $icon = "fa-image", $color = '')
    {
        $color = ' style="color:'.$color.';" ';

        return array('title' => $title, 'url' => $do != $method ? $this->createWebUrl($method, array('op' => 'display')) : '',
            'active' => $do == $method ? ' active' : '',
            'append' => array(
                'title' => '<i '.$color.' class="fa fa-angle-right"></i>',
                )
            );
    }

/*    function createSubMenu($title, $do, $method, $icon = "fa-image", $color = '#d9534f', $storeid)
    {
        $color = ' style="color:'.$color.';" ';
        $url = $this->createWebUrl($method, array('op' => 'display', 'storeid' => $storeid));
        if ($method == 'stores') {
            $url = $this->createWebUrl('stores', array('op' => 'post', 'id' => $storeid, 'storeid' => $storeid));
        }

        return array('title' => $title, 'url' => $do != $method ? $url : '',
            'active' => $do == $method ? ' active' : '',
            'append' => array(
                'title' => '<i class="fa '.$icon.'"></i>',
            )
        );
    }*/
    function createSubMenu($title, $do, $method, $icon = "fa-image", $color = '#d9534f')
    {
        $color = ' style="color:'.$color.';" ';
        $url = $this->createWebUrl2($method, array('op' => 'display'));
        if ($method == 'stores2') {
            $url = $this->createWebUrl2('stores2', array('op' => 'post', 'id' => $storeid));
        }
        return array('title' => $title, 'url' => $do != $method ? $url : '',
            'active' => $do == $method ? ' active' : '',
            'append' => array(
                'title' => '<i class="fa '.$icon.'"></i>',
                )
            );
    }

      //获取商家信息
      public function getStoreById($id)
    {
        $store = pdo_fetch("SELECT * FROM " . tablename('zh_jdgjb_seller') . " WHERE id=:id LIMIT 1", array(':id' => $id));
        return $store;
    }


    public function set_tabbar($action, $storeid)
    {
        $actions_titles = $this->actions_titles;
        $html = '<ul class="nav nav-tabs">';
        foreach ($actions_titles as $key => $value) {
            if ($key == 'stores') {
                $url = $this->createWebUrl('stores', array('op' => 'post', 'id' => $storeid));
            } else {
                $url = $this->createWebUrl($key, array('op' => 'display', 'storeid' => $storeid));
            }

            $html .= '<li class="' . ($key == $action ? 'active' : '') . '"><a href="' . $url . '">' . $value . '</a></li>';
        }
        $html .= '</ul>';
        return $html;
    }

    public   function getSon($pid ,$arr){
        $newarr=array();
        foreach ($arr as $key => $value) {
            if($pid==$value['type_id']){
                $newarr[]=$value; 
                continue;                     
            }      
        }
        return $newarr;
        
    }

    function getLevel($members,$xf_money){     
       for($i=0;$i<count($members);$i++){
          if($xf_money>=$members[$i]['value']){
            return  $members[$i]['id'];       
        }
        if($xf_money<$members[$i]['value']&&$xf_money>$members[$i+1]['value']){
            return $members[$i+1]['id'];
        }
    }
}

function getScore($order_id){   
    global $_W, $_GPC;
    $orderInfo=pdo_get('zh_jdgjb_order',array('id'=>$order_id));
    $scoreInfo=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
    $score= floor($orderInfo['dis_cost']*$scoreInfo['xf_score']);
    return $score;

}

function saveScore($order_id,$user_id,$score){   
    global $_W, $_GPC;
    $data['user_id']=$user_id;
    $data['order_id']=$order_id;
    $data['score']=$score;
    $data['note']='购物所得';
    $data['time']=time();
    $data['uniacid']=$_W['uniacid'];
    $rst=pdo_insert('zh_jdgjb_score',$data);
    return $rst;

}

  //退款
public function wxrefund($order_id){
    global $_W, $_GPC;
    include_once IA_ROOT . '/addons/zh_jdgjb/cert/WxPay.Api.php';
    load()->model('account');
    load()->func('communication');
    $refund_order =pdo_get('zh_jdgjb_order',array('id'=>$order_id));  
    $WxPayApi = new WxPayApi();
    $input = new WxPayRefund();
    $path_cert = IA_ROOT . "/addons/zh_jdgjb/cert/".'apiclient_cert_' .$_W['uniacid'] . '.pem';
    $path_key = IA_ROOT . "/addons/zh_jdgjb/cert/".'apiclient_key_' . $_W['uniacid'] . '.pem';
    $account_info = $_W['account'];   
    $res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
    $appid=$res['appid'];
    $key=$res['wxkey'];
    $mchid=$res['mchid']; 
    $out_trade_no=$refund_order['out_trade_no'];
    $fee = $refund_order['total_cost'] * 100;
    $input->SetAppid($appid);
    $input->SetMch_id($mchid);
    $input->SetOp_user_id($mchid);
    $input->SetRefund_fee($fee);
    $input->SetTotal_fee($fee);
           // $input->SetTransaction_id($refundid);
    $input->SetOut_refund_no($refund_order['order_no']);
    $input->SetOut_trade_no($out_trade_no);
    $result = $WxPayApi->refund($input, 6, $path_cert, $path_key, $key);
    return $result;
}

//入住模板消息
public function rzMessage($order_id){
  global $_W, $_GPC;
  function getaccess_token($_W){
    $res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
    $appid=$res['appid'];
    $secret=$res['appsecret'];
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    $data = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($data,true);
    return $data['access_token'];
}

   //设置与发送模板信息
function set_msg($_W,$order_id){
    $access_token = getaccess_token($_W);
    $res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
    $sql="select a.*,b.tel as seller_tel from " . tablename("zh_jdgjb_order")."a left join".tablename('zh_jdgjb_seller')."b on a.seller_id=b.id WHERE a.id=:order_id  ";
    $list=pdo_fetch($sql,array(':order_id'=>$order_id));
    $userInfo=pdo_get('zh_jdgjb_user',array('id'=>$list['user_id']),'openid');
        // var_dump($userInfo);die;
    $time1=substr($list['arrival_time'],0,10);
        //下面是要填充模板的信息
  $formwork = [
                'touser' => $userInfo["openid"],
                'template_id' => $res["rz_tid"],
                'data' => [
                    'thing1' => [
                        'value' => $list['seller_name'],
                        'color' => '#173177',
                    ],
                    'name7' => [
                        'value' => $list['name'],
                        'color' => '#173177',
                    ],
                    'date3' => [
                        'value' => $list['arrival_time'],
                        'color' => '#173177',
                    ],
                    'thing6' => [
                        'value' => "请携带好身份证原件",
                        'color' => '#173177',
                    ],
                ],
            ];
$url = "https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=".$access_token."";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch, CURLOPT_POST,1);
$formwork = json_encode($formwork);
curl_setopt($ch, CURLOPT_POSTFIELDS,$formwork);
$data = curl_exec($ch); 
curl_close($ch);

   $res=pdo_delete('zh_jdgjb_dingyue',array('user_id'=>$list['user_id'],'tpl_id'=>$res["rz_tid"]));

}
echo set_msg($_W,$order_id);
}


//入住模板消息
public function jjrzMessage($order_id){
  global $_W, $_GPC;
  function getaccess_token($_W){
    $res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
    $appid=$res['appid'];
    $secret=$res['appsecret'];
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    $data = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($data,true);
    return $data['access_token'];
}

   //设置与发送模板信息
function set_msg($_W,$order_id){
    $access_token = getaccess_token($_W);
    $res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
    $sql="select a.*,b.tel as seller_tel from " . tablename("zh_jdgjb_order")."a left join".tablename('zh_jdgjb_seller')."b on a.seller_id=b.id WHERE a.id=:order_id  ";
    $list=pdo_fetch($sql,array(':order_id'=>$order_id));
    $userInfo=pdo_get('zh_jdgjb_user',array('id'=>$list['user_id']),'openid');
    $content="商家暂时无法接单！";
         
    $time=date('Y-m-d H:i',time());
        //下面是要填充模板的信息
    $formwork = [
                'touser' => $userInfo["openid"],
                'template_id' => $res["jjrz_tid"],
                'data' => [
                    'phrase2' => [
                        'value' => $content,
                        'color' => '#173177',
                    ],
                    'thing1' => [
                        'value' => $list['seller_name'],
                        'color' => '#173177',
                    ],
                    'character_string3' => [
                        'value' => $list['order_no'],
                        'color' => '#173177',
                    ],
                    'phone_number10' => [
                        'value' => $list['seller_tel'],
                        'color' => '#173177',
                    ],
                    'thing11' => [
                        'value' => $content,
                        'color' => '#173177',
                    ],
                ],
            ];
$url = "https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=".$access_token."";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch, CURLOPT_POST,1);
$formwork = json_encode($formwork);
curl_setopt($ch, CURLOPT_POSTFIELDS,$formwork);
$data = curl_exec($ch);//echo "<pre>";print_r($data);die;
curl_close($ch);
    $res=pdo_delete('zh_jdgjb_dingyue',array('user_id'=>$list['user_id'],'tpl_id'=>$res["jjrz_tid"]));

}
echo set_msg($_W,$order_id);
}

















//余额退还
public function saveRecharge($order_id){
    global $_W, $_GPC;
    $orderInfo=pdo_get('zh_jdgjb_order',array('id'=>$order_id));
    $data['user_id']=$orderInfo['user_id'];
    $data['cz_money']=$orderInfo['total_cost'];
    $data['note']='订单退款';
    $data['state']=2;
    $data['time']=time();
    $data['uniacid']=$_W['uniacid'];
    $res=pdo_insert('zh_jdgjb_recharge',$data);
    if($res){
        return'1';
    }else{
        return '2';
    }
}


//修改房间数量

public function roomNum($order_id){
    global $_W, $_GPC;
    $order=pdo_get('zh_jdgjb_order',array('id'=>$order_id));
        //修改房间数量
    $dt_start = strtotime(substr($order['arrival_time'],0,10));  
    $dt_end = strtotime(substr($order['departure_time'],0,10));
    while ($dt_start<$dt_end){
        $dateday=$dt_start;
        $res=pdo_get('zh_jdgjb_roomnum',array('rid'=>$order['room_id'],'dateday'=>$dateday));
        if($res['id']){
            $nums=$res['nums']-$order['num'];
            pdo_update('zh_jdgjb_roomnum',array('nums'=>$nums),array('rid'=>$order['room_id'],'dateday'=>$dateday));
        }else{
            $uniacid=$_W['uniacid'];    
            $roomArr=pdo_get('zh_jdgjb_room',array('id'=>$order['room_id'],'uniacid'=>$order['uniacid']),array('total_num','id'));
            $nums=$roomArr['total_num']-$order['num'];
            pdo_insert('zh_jdgjb_roomnum',array('nums'=>$nums,'rid'=>$roomArr['id'],'dateday'=>$dateday));
        }
        $dt_start = strtotime('+1 day',$dt_start);
    }
}



//确认订单模板消息
public function queryOrderMessage($order_id){
  global $_W, $_GPC;
  function getaccess_token($_W){
    $res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));

    $appid=$res['appid'];
    $secret=$res['appsecret'];
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    $data = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($data,true);
    return $data['access_token'];
}

   //设置与发送模板信息
function set_msg($_W,$order_id){
    $access_token = getaccess_token($_W);
    $res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
    $sql="select a.*,b.tel as seller_tel from " . tablename("zh_jdgjb_order")."a left join".tablename('zh_jdgjb_seller')."b on a.seller_id=b.id WHERE a.id=:order_id  ";
    $list=pdo_fetch($sql,array(':order_id'=>$order_id));
    $userInfo=pdo_get('zh_jdgjb_user',array('id'=>$list['user_id']),'openid');
        // var_dump($userInfo);die;
    $time1=substr($list['arrival_time'],0,10);
    $time2=substr($list['departure_time'],0,10);
        //下面是要填充模板的信息
    $formwork = [
                'touser' => $userInfo["openid"],
                'template_id' => $res["tid3"],
                'data' => [
                    'character_string1' => [
                        'value' => $list['order_no'],
                        'color' => '#173177',
                    ],
                    'thing2' => [
                        'value' => $list['seller_name'],
                        'color' => '#173177',
                    ],
                     'phrase3' => [
                        'value' => "订单已确认",
                        'color' => '#173177',
                    ],
                    'date4' => [
                        'value' => $time1,
                        'color' => '#173177',
                    ],
                    'date5' => [
                        'value' => $time2,
                        'color' => '#173177',
                    ],
                   
                ],
            ];

    		$formwork = json_encode($formwork);
    		$url = "https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=".$access_token."";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$formwork);
$data = curl_exec($ch);
curl_close($ch);
$res=pdo_delete('zh_jdgjb_dingyue',array('user_id'=>$list['user_id'],'tpl_id'=>$res["tid3"]));

}
echo set_msg($_W,$order_id);
}


//拒绝订单模板消息
public function rejectOrderMessage($order_id){
  global $_W, $_GPC;
  function getaccess_token($_W){
    $res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
    $appid=$res['appid'];
    $secret=$res['appsecret'];
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
    $data = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($data,true);
    return $data['access_token'];
}

   //设置与发送模板信息
function set_msg($_W,$order_id){
    $access_token = getaccess_token($_W);
    $res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
    $sql="select a.*,b.tel as seller_tel from " . tablename("zh_jdgjb_order")."a left join".tablename('zh_jdgjb_seller')."b on a.seller_id=b.id WHERE a.id=:order_id  ";
    $list=pdo_fetch($sql,array(':order_id'=>$order_id));
    $userInfo=pdo_get('zh_jdgjb_user',array('id'=>$list['user_id']),'openid');
        // var_dump($userInfo);die;
    $time1=substr($list['arrival_time'],0,10);
        //下面是要填充模板的信息
    $formwork = [
                'touser' => $userInfo["openid"],
                'template_id' => $res["tid4"],
                'data' => [
                    'thing5' => [
                        'value' => "很抱歉,房型已满无法提供服务",
                        'color' => '#173177',
                    ],
                    'character_string1' => [
                        'value' => $list['order_no'],
                        'color' => '#173177',
                    ],
                     'phrase3' => [
                        'value' => "订单已拒绝",
                        'color' => '#173177',
                    ],
                   
                ],
            ];

    		$formwork = json_encode($formwork);
    		$url = "https://api.weixin.qq.com/cgi-bin/message/subscribe/send?access_token=".$access_token."";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$formwork);
$data = curl_exec($ch);
curl_close($ch);
$res=pdo_delete('zh_jdgjb_dingyue',array('user_id'=>$list['user_id'],'tpl_id'=>$res["tid4"]));
return $data;

}
echo set_msg($_W,$order_id);
}


public function getaccess_token(){
        global $_GPC, $_W;
        $tokenName='access_token'.$_W['uniacid'];
        $timeName='access_token_time'.$_W['uniacid'];
        load()->classs('wesession');
        WeSession::start($_W['uniacid'], CLIENT_IP);
        if($_SESSION[$timeName]<time() || !$_SESSION[$tokenName]){
            $res=pdo_get('zh_jdgjb_system',array('uniacid'=>$_W['uniacid']));
            $appid=$res['appid'];
            $secret=$res['appsecret'];
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
            $data = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($data,true);
            $_SESSION[$tokenName]=$data['access_token'];
            $_SESSION[$timeName]=time()+300;
            return $data['access_token'];
        }else{
            return $_SESSION[$tokenName];
        }
        
    }
    public function httpRequest($url,$data = null){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            if (!empty($data)){
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //执行
            $output = curl_exec($curl);
            curl_close($curl);
            return $output;
        }
    //查找模板的关键词列表
    public function getKeyword($id){
        global $_GPC, $_W;
        $url='https://api.weixin.qq.com/cgi-bin/wxopen/template/library/get?access_token='.$this->getaccess_token();
        $formWork = '{
            "id": "' . $id . '"
        }';
        $data = $this->httpRequest($url, $formWork);
        return json_decode($data,true)['keyword_list'];
    }
    //生成模板
    public function generateTemplate($id,$keyword_id_list){
        global $_GPC, $_W;
        $key=$this->getKeyword($id);
        $list=[];
        for($i=0;$i<count($keyword_id_list);$i++){
            
            for($k=0;$k<count($key);$k++){
                if($keyword_id_list[$i]==$key[$k]['name']){
                    $list[]=$key[$k]['keyword_id'];
                }
            }
        }
        $url='https://api.weixin.qq.com/cgi-bin/wxopen/template/add?access_token='.$this->getaccess_token();
        $formWork = '{
                 "id": "' . $id . '",
                 "keyword_id_list": ' . json_encode($list) . '
         }';
        $data = $this->httpRequest($url, $formWork);
        // print_r($data);die;
        return json_decode($data,true)['template_id'];


    }


}