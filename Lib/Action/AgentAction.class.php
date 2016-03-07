<?php

class AgentAction extends CommonAction
{
	public function index()
	{
		// 接收参数
		$intPid    = (int)get('pid', 1);			// 进入项目名称
        // 查询数据
		$agentList = M('project_agent')->field('id, projectId, en_name, cn_name')->where(array('projectId' => $intPid, 'status' => 1))->order('id ASC')->select();
        // 注入变量
		$this->assign('agentList', $agentList);
		$this->display();
	}
}
?>