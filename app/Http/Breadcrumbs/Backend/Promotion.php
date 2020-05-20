<?php

Breadcrumbs::register('admin.promotions.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.promotions.management'), route('admin.promotions.index'));
});

Breadcrumbs::register('admin.promotions.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.promotions.index');
    $breadcrumbs->push(trans('menus.backend.promotions.create'), route('admin.promotions.create'));
});

Breadcrumbs::register('admin.promotions.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.promotions.index');
    $breadcrumbs->push(trans('menus.backend.promotions.edit'), route('admin.promotions.edit', $id));
});
