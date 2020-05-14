<?php
global $_GPC, $_W;
$GLOBALS['frames'] = $this->getMainMenu();
$info=pdo_get('zh_jdgjb_ad',array('id'=>$_GPC['id']));
if(checksubmit('submit')){
         $data['logo']=$_GPC['logo'];
        
        $data['orderby']=$_GPC['orderby'];
        $data['status']=$_GPC['status'];
        $data['title']=$_GPC['title'];
        $data['type']=$_GPC['type'];
        if($_GPC['state']==1){
              $data['state']=1;
            $data['src']=$_GPC['src'];
             $data['wb_src']='';
            $data['xcx_name']='';
            $data['appid']='';
        }
         if($_GPC['state']==2){
             $data['state']=2;
           $data['src']='';
             $data['wb_src']=$_GPC['wb_src'];
            $data['xcx_name']='';
            $data['appid']='';
        }
          if($_GPC['state']==3){
            $data['state']=3;
           $data['src']='';
            $data['wb_src']='';
            $data['xcx_name']=$_GPC['xcx_name'];
            $data['appid']=$_GPC['appid'];
        }
        $data['uniacid']=$_W['uniacid'];
     if($_GPC['id']==''){  
        $res=pdo_insert('zh_jdgjb_ad',$data);
        if($res){
             message('添加成功！', $this->createWebUrl('ad'), 'success');
        }else{
             message('添加失败！','','error');
        }
    }else{
        $res=pdo_update('zh_jdgjb_ad',$data,array('id'=>$_GPC['id']));
        if($res){
             message('编辑成功！', $this->createWebUrl('ad'), 'success');
        }else{
             message('编辑失败！','','error');
        }
    }
}
include $this->template('web/addad');