<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbcController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // 添加 "createPost" 权限
        $createPost = $auth->createPermission('createPost');
        $createPost->description = '新增文章';
        $auth->add($createPost);

        // 添加 "updatePost" 权限
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = '修改文章';
        $auth->add($updatePost);

        // 添加 "deletePost" 权限
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = '删除文章';
        $auth->add($deletePost);

        // 添加 "approvePost" 权限
        $approvePost = $auth->createPermission('approvePost');
        $approvePost->description = '审核文章';
        $auth->add($approvePost);


        $postAdmin = $auth->createRole('postAdmin');
        $postAdmin->description='文章管理员';
        $auth->add($postAdmin);
        $auth->addChild($postAdmin, $updatePost);
        $auth->addChild($postAdmin, $createPost);
        $auth->addChild($postAdmin, $deletePost);

        $postOperator = $auth->createRole('postOperator');
        $postOperator->description='文章操作员';
        $auth->add($postOperator);
        $auth->addChild($postOperator, $deletePost);

        $commentAuth = $auth->createRole('commentAuth');
        $commentAuth->description='评论审核员';
        $auth->add($commentAuth);
        $auth->addChild($commentAuth, $approvePost);


        $admin = $auth->createRole('admin');
        $admin->description='系统管理员';
        $auth->add($admin);
        $auth->addChild($admin, $postAdmin);
        $auth->addChild($admin, $commentAuth);
        // 为用户指派角色。其中 1 和 2 是由 IdentityInterface::getId() 返回的id （译者注：user表的id）
        // 通常在你的 User 模型中实现这个函数。
        $auth->assign($admin, 1);
        $auth->assign($postAdmin, 2);
        $auth->assign($postOperator, 3);
        $auth->assign($commentAuth, 4);
    }
}