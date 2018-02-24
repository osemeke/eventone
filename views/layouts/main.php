<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */
//-------------------------------

use app\models\CategoryGroup;

// to retrieve all *active* customers and order them by their ID:
$groups = CategoryGroup::find()->orderBy('sort')->all();

// foreach ($groups as $group) {
//     // $orders = $customer->orders;
//     $categories = $group->categories;

//     // foreach ($categories as $category) {
//     //     print_r($category);
//     // }
//     // print_r($categories);

//     echo $group->id . "----" . $group->name . "<br />";
//     // echo $categories[0]['name'];// . "----" . $categories->name . "<br />";


//     foreach ($categories as $category) {
//         echo $category['name']."<br>";
//     }
// }
  // $categories = Category::find()->asArray()->all();

  // echo "<div class='list-group'>";
  // foreach ($categories as $category) {
  //     echo  "<a href=\"#\" class='list-group-item'>" . $category['name'] . "</a>";
  // }
  // echo "</div>";


// exit;
//-------------------------------
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= Url::base() ?>/favicon.ico" type="image/x-icon" />

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">

        <?php
            NavBar::begin([
                // 'brandLabel' => Yii::$app->name,
                // 'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    // 'class' => 'navbar-inverse navbar-fixed-top',
                    'id' => 'top',
                ],
            ]);
             
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Photo Catalog', 'url' => ['/catalog-photo/search']];
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {



            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Catalog', 'url' => ['/catalog-photo/index']],
                ['label' => 'Services', 'url' => ['/service/index']],
                ['label' => 'Profile', 'url' => ['/user-profile/edit']],
                ['label' => 'Wallet', 'url' => ['/wallet/balance']],
                ['label' => 'Targeted Advert', 'url' => ['/targeted-advert/index']],
         
                // ['label' => 'About', 'url' => ['/site/about']],
                //['label' => 'Contact', 'url' => ['/site/contact']],
            ];



                if(Yii::$app->user->identity->role <= 2) {
                $menuItems[] = [
                        'label' => 'Admin',
                        'items' => [
                             ['label' => 'Users', 'url' => ['/user-profile/index']],
                             ['label' => 'FAQs', 'url' => ['/faq/index']],
                             ['label' => 'Featured', 'url' => ['/featured/index']],
                             ['label' => 'Advert', 'url' => ['/advert/index']],
                             ['label' => 'State', 'url' => ['/state/index']],
                             ['label' => 'City', 'url' => ['/city/index']],
                             // ['label' => 'Category Groups', 'url' => ['/category-group/index']],
                        ],
                    ];
                }

                if(Yii::$app->user->identity->role == 1) {
                $menuItems[] = [
                        'label' => 'Super Admin',
                        'items' => [
                             '<li class="dropdown-header">User Management</li>',
                             ['label' => 'Users', 'url' => ['/user/index']],
                             ['label' => 'Create New User', 'url' => ['/user/create']],
                             '<li class="divider"></li>',
                             '<li class="dropdown-header">Categories</li>',
                             ['label' => 'Categories', 'url' => ['/category/index']],
                             ['label' => 'Category Groups', 'url' => ['/category-group/index']],
                             '<li class="divider"></li>',
                             '<li class="dropdown-header">Accounting</li>',
                             ['label' => 'Wallets', 'url' => ['/wallet/index']],
                             ['label' => 'Banks', 'url' => ['/bank/index']],
                             ['label' => 'Accounts', 'url' => ['/account/index']],
                             ['label' => 'Transaction Types', 'url' => ['/transaction-type/index']],
                        ],
                    ];
                }

                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'encodeLabels' => false,
                // 'id' => 'top-links',
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

<!-- logo and search form -->
<header> 
<div class="container"> 
<div class="row"> 
<div class="col-sm-8"> 
<div id="logo"> 
<a href="#"><?= Html::img('@web/images/logo.png', ['alt' => Yii::$app->name,'class'=>'img-responsive']) ?></a> 
</div> 
</div> 
</div> 
</div> 
</header>


<!-- main menu begins -->
<div class="container"> 
  <nav id="menu" class="navbar"> 
    <div class="navbar-header"><span id="category" class="visible-xs">Categories</span> 
      <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button> 
    </div>
    
    <div class="collapse navbar-collapse navbar-ex1-collapse"> 
    <ul class="nav navbar-nav"> 
    

<?php
$i = 0;
foreach ($groups as $group) {
    $categories = $group->categories;
    echo "
          <li class='dropdown'><a href='&amp;path=20' class='dropdown-toggle' data-toggle='dropdown'>" . $group->name . "</a> 
            <div class='dropdown-menu'> 
              <div class='dropdown-inner'> 
    ";
    //inner
    foreach ($categories as $category) {
      if ($i == 0) { echo "<ul class='list-unstyled'>"; }
      $i++;
        echo "<li>" . Html::a($category['name'], ['vendors/category?id=' . $category['id']]) . "</li>";
      if ($i == 5) { $i = 0; echo "</ul>"; }

    }
      if ($i > 0) { $i = 0; echo "</ul>"; }

    echo "
                </div>
                ".Html::a("See All " . $group->name, ['vendors/group?id=' . $group->id], ["class"=>"see-all"]) .
            "</div> 
          </li> 
    ";
}

?>



<!--<li><a href="">Photo Catalog</a></li> <li><a href="&amp;path=24">Phones &amp; PDAs</a></li>  --> 
    
        </ul> 
    </div> 
  
  </nav> 
</div> 

<!-- main menu ends -->


        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'encodeLabels' => false,
            'homeLink' => ['label' => '<i class="fa fa-home"></i>', 'url' => ['site/index']],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        </div>
    </div>

<footer> 
  <div class="container"> 

  <h5>Categories</h5>            

  <div class="row"> 
    
<?php
$i = 0;

foreach ($groups as $group) 
{
    $categories = $group->categories;
    foreach ($categories as $category) 
    {
      if ($i == 0) { echo "<div class='col-sm-2'> <ul class='list-unstyled'>"; }
      $i++;
        //echo "<li><a href=''>" . $category['name'] . "</a></li> ";
        echo "<li>" . Html::a($category['name'], ['vendors/category?id=' . $category['id']]) . "</li>";
    if ($i == 8) { $i = 0; echo "</ul></div>"; }
    }
}
    if ($i > 0) { $i = 0; echo "</ul></div>"; }

?>
 
    </div> 

    <hr> 

    <div class="row"> 
    
        <div class="col-sm-3"> 
            <h5>Information</h5> 
                <ul class="list-unstyled"> 
                    <li><?= Html::a('About Us',['site/about'])?></li> 
                    <li><?= Html::a('Privacy Policy',['site/privacy'])?></li> 
                    <li><?= Html::a('Terms &amp; Conditions',['site/terms'])?></li> 
                </ul> 
        </div> 
        
        <div class="col-sm-3"> 
            <h5>Customer Service</h5> 
                <ul class="list-unstyled"> 
                      <li><?= Html::a('Contact Us',['site/contact'])?></li> 
                      <li><?= Html::a('FAQs',['site/faqs'])?></li> 
                </ul> 
        </div> 
        
        <div class="col-sm-3"> 
            <h5>Extras</h5> 
                <ul class="list-unstyled"> 
                    <li><?= Html::a('Photo Catalog',['catalog-photo/search'])?></li> 
                    <li><?= Html::a('Affiliates',['site/affiliate'])?></li> 
                </ul> 
        </div> 
        
        <div class="col-sm-3"> 
            <h5>My Account</h5> 
                <ul class="list-unstyled"> 

        <?php
            if (Yii::$app->user->isGuest) {
        ?>
            <li><?= Html::a('Login',['site/login'])?></li> 
            <li><?= Html::a('Signup',['site/signup'])?></li>
        <?php
            } else {
        ?>

            <li><?= 
            Html::a('Logout', ['site/logout'], [
                'data' => [
                    'method' => 'post',
                ],
            ]);
            //Html::a('Logout',['site/logout'])?></li> 
        <?php
            }
        ?>                      
                </ul> 
        </div> 
        
    </div> 
    
    <hr> 
            <p class="pull-left">&copy; <?= Yii::$app->params['companyName'] ?> <?= date('Y') ?></p>
            <p class="pull-right"><a href="#"></a></p>
  </div> 
</footer> 
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
