<?php
// By:Woodu ver 3.2
// 2012 02 11
class IndexAction extends Action
{

    public function Index() 
    {
      //echo 'aaa';
      $Demo = new Model('youxijiting');//创建查询对象
      $condition['deleted'] = 0;
      $list = $Demo->where($condition)->order('id desc')->limit('1')->select();//赋予条件 
      //dump($list);
      $this->assign('list',$list);
      $this->display(); // 输出模板
    }


}


?>