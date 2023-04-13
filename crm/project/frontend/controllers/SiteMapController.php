<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\helpers\Url;
use backend\modules\catalog\models\StoreCategory;
use backend\modules\catalog\models\StoreProduct;

class SiteMapController extends Controller
{
    public function actionIndex()
    {
        $begin = '<?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
        $end = '</urlset>';
        
        $string = '
        <url><loc>https://geo-cadastr.ru</loc><priority>0.9</priority></url>
        <url><loc>https://geo-cadastr.ru/about</loc><priority>0.5</priority></url>
        <url><loc>https://geo-cadastr.ru/contact</loc><priority>0.5</priority></url>
        <url><loc>https://geo-cadastr.ru/services</loc><priority>0.5</priority></url>
        ';
        
        $category = StoreCategory::find()->all();
        foreach ($category as $cat) {
            $srting = $string . '<url><loc>https://geo-cadastr.ru/'.$cat->slug.'</loc><priority>0.5</priority></url>';
        }
        $product = StoreProduct::find()->all();
        foreach ($product as $prod) {
            $string = $string . '<url><loc>https://geo-cadastr.ru/'.$prod->slug.'</loc><priority>0.5</priority></url>';
        }
        
        $siteMap = $begin .$string . $end;
        
        $fp = fopen("E:\server\domains\cadastr.loc\sitemap.xml", "w");
        
        fwrite($fp, $siteMap);
        
        fclose($fp);
        
    }
}
