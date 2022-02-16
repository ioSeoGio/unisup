<?php

namespace app\modules\admin\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;

class Menu extends Widget
{
    const WITHOUT_GROUP = 'Other';

    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();

        $menu = [
            Yii::t('cruds', 'Settings') => [
                [
                    'name' => Yii::t('cruds', 'My Settings'),
                    'url' => Url::to(['/admin/user/settings', 'id' => Yii::$app->user->id]),
                    'can' => Yii::$app->user->can('app_user_my-settings', ['userId' => Yii::$app->user->id]),
                ],
                [
                    'name' => Yii::t('models', 'Site Settings'),
                    'url' => Url::to(['/admin/site-setting/update', 'id' => 1]),
                    'can' => Yii::$app->user->can('app_site-setting_index'),
                ],
            ],
            Yii::t('cruds', self::WITHOUT_GROUP) => [
                [
                    'name' => Yii::t('models', 'Carts'),
                    'url' => Url::to(['/admin/cart/index']),
                    'can' => Yii::$app->user->can('app_cart_index'),
                ],
                [
                    'name' => Yii::t('models', 'Call Requests'),
                    'url' => Url::to(['/admin/call-request/index']),
                    'can' => Yii::$app->user->can('app_user_index'),
                ],
                // [
                    // 'name' => Yii::t('models', 'Cart Products'),
                    // 'url' => => Url::to(['/admin/cart-product/index']),
                // ]
                [
                    'name' => Yii::t('models', 'Categories'),
                    'url' => Url::to(['/admin/category/index']),
                    'can' => Yii::$app->user->can('app_category_index'),
                ],
                [
                    'name' => Yii::t('models', 'Sertificates'),
                    'url' => Url::to(['/admin/certificate/index']),
                    'can' => Yii::$app->user->can('app_certificate_index'),
                ],
                [
                    'name' => Yii::t('models', 'Colors'),
                    'url' => Url::to(['/admin/color/index']),
                    'can' => Yii::$app->user->can('app_color_index'),
                ],
                [
                    'name' => Yii::t('models', 'Comments'),
                    'url' => Url::to(['/admin/comment/index']),
                    'can' => Yii::$app->user->can('app_comment_index'),
                ],
                // [
                    // 'name' => Yii::t('models', 'Employees'),
                    // 'url' => Url::to(['/admin/employee/index']),
                // ]

                [
                    'name' => Yii::t('models', 'Groups'), 
                    'url' => Url::to(['/admin/group/index']),
                    'can' => Yii::$app->user->can('app_group_index'),
                ],
                [
                    'name' => Yii::t('models', 'Text Translations'),
                    // 'url' => Url::to(['/admin/message/index']),
                    'url' => Url::to(['/admin/source-message/category?category=app']),
                    'can' => Yii::$app->user->can('app_source-message_index'),
                ],
                [
                    'name' => Yii::t('models', 'News'),
                    'url' => Url::to(['/admin/news/index']),
                    'can' => Yii::$app->user->can('app_news_index'),
                ],
                [
                    'name' => Yii::t('models', 'Pages'),
                    'url' => Url::to(['/admin/page/index']),
                    'can' => Yii::$app->user->can('app_page_index'),
                ],
                [
                    'name' => Yii::t('models', 'Parameters'),
                    'url' => Url::to(['/admin/parameter/index']),
                    'can' => Yii::$app->user->can('app_parameter_index'),
                ],
                // [
                    // 'name' => Yii::t('models', 'Product Colors'),
                    // 'url' => => Url::to(['/admin/product-color/index']),
                // ],
                [
                    'name' => Yii::t('models', 'Products'),
                    'url' => Url::to(['/admin/product/index']),
                    'can' => Yii::$app->user->can('app_product_index'),
                ],
                // [
                    // 'name' => Yii::t('models', 'Product Files'),
                    // 'url' => Url::to(['/admin/product-file/index']),
                // ]
                // [
                    // 'name' => Yii::t('models', 'Product Parameters'),
                    // 'url' => Url::to(['/admin/product-parameter/index']),
                // ]
                // [
                    // 'name' => Yii::t('models', 'Product Photos'),
                    // 'url' => Url::to(['/admin/product-photo/index']),
                // ]
                [
                    'name' => Yii::t('models', 'Promotions'),
                    'url' => Url::to(['/admin/promotion/index']),
                    'can' => Yii::$app->user->can('app_promotion_index'),
                ],
                // [
                    // 'name' => Yii::t('models', 'Promotion Targets'),
                    // 'url' => Url::to(['/admin/promotion-target/index']),
                // ]
                // [
                    // 'name' => Yii::t('models', 'Seen Products'),
                    // 'url' => Url::to(['/admin/seen-product/index']),
                // ]
                // [
                    // 'name' => Yii::t('models', 'Text Translations (original)'),
                    // 'url' => Url::to(['/admin/source-message/index']),
                // ]
                [
                    'name' => Yii::t('models', 'Users'),
                    'url' => Url::to(['/admin/user/index']),
                    'can' => Yii::$app->user->can('app_user_index'),
                ],
                [
                    'name' => Yii::t('models', 'Employees'),
                    'url' => Url::to(['/admin/employee/index']),
                    'can' => Yii::$app->user->can('app_employee_index'),
                ],
                [
                    'name' => Yii::t('models', 'Watermarks'),
                    'url' => Url::to(['/admin/watermark/index']),
                    'can' => Yii::$app->user->can('app_watermark_index'),
                ],
                [
                    'name' => Yii::t('cruds', 'Slider'),
                    'url' => Url::to(['/admin/main-slider-instance/edit']),
                    'can' => Yii::$app->user->can('app_main-slider-instance_index'),
                ],
            ],
        ];

        
        return $this->render('menu', [
            'widgetClass' => $this->className(),

            'content' => $content,
            'menu' => $menu,
        ]);
    }
}

 ?>
