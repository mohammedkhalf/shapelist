<?php

Breadcrumbs::register('admin.carts.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.carts.management'), route('admin.carts.index'));
});

Breadcrumbs::register('admin.carts.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.carts.index');
    $breadcrumbs->push(trans('menus.backend.carts.create'), route('admin.carts.create'));
});

Breadcrumbs::register('admin.carts.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.carts.index');
    $breadcrumbs->push(trans('menus.backend.carts.edit'), route('admin.carts.edit', $id));
});
