<?php
/**
 * @var array $goods
 * @var \App\models\Good $good
 */

foreach ($goods as $good)
{
    echo<<<php
    <a href="?a=user&id={$good->id}">
        {$good->name}
    </a> <hr>
php;


}