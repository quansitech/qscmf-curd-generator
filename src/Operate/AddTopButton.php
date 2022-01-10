<?php

namespace CurdGen\Operate;


class AddTopButton implements IOperate,ITopButton
{

    public function topButtonParse(){
        return <<<sample
->addTopButton('addnew')
sample;
    }

    public function operateParse()
    {
        return <<<sample
    public function add(){
        if (IS_POST) {
            parent::autoCheckToken();
            \$data = I('post.');

            \$model = D('{DummyModel}');
            \$r = \$model->createAdd(\$data);
            if(\$r === false){
                \$this->error(\$model->getError());
            }
            else{
                sysLogs('新增{DummyModelTitle}, id:' . \$r);


                \$this->success(l('add') . l('success'), 'javascript:location.href=document.referrer;');
            }
        }
        else {
            \$builder = new \Qscmf\Builder\FormBuilder();

            \$data_list = array(
                "status"=>1
            );

            if(\$data_list){
                \$builder->setFormData(\$data_list);
            }

            {DummyFormExtra}
            \$builder->setMetaTitle('新增{DummyModelTitle}')
                ->setPostUrl(U('add'))
                {DummyFormColumns}
                ->display();
        }
    }
sample;

    }

}