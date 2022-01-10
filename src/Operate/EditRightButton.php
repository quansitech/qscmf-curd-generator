<?php

namespace CurdGen\Operate;


class EditRightButton implements IOperate,IRightButton
{

    public function rightButtonParse(){
        return <<<sample
->addRightButton('edit')
sample;
    }

    public function operateParse()
    {
        return <<<sample
    public function edit(\$id){
        if (IS_POST) {
            parent::autoCheckToken();
            \$m_id = I('post.id');
            \$data = I('post.');
            \$model = D('{DummyModel}');
            if(!\$m_id){
                E('缺少{DummyModelTitle}ID');
            }

            \$ent = \$model->getOne(\$m_id);
            if(!\$ent){
                E('不存在{DummyModelTitle}');
            }

            {DummyEditColumns}
            if(\$model->createSave(\$ent) === false){
                \$this->error(\$model->getError());
            }
            else{
                sysLogs('修改{DummyModelTitle}, id:' . \$m_id);
                \$this->success('修改成功', 'javascript:location.href=document.referrer;');
            }
        } else {
            \$info = D('{DummyModel}')->getOne(\$id);

            {DummyFormExtra}
            \$builder = new \Qscmf\Builder\FormBuilder();
            \$builder->setMetaTitle('编辑{DummyModelTitle}')
                ->setPostUrl(U('edit'))
                ->addFormItem('id', 'hidden', 'ID')
                {DummyFormColumns}
                ->setFormData(\$info)
                ->display();

        }
    }
sample;

    }

}