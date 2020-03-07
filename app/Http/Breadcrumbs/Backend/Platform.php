<?php

Breadcrumbs::register('admin.platforms.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.platforms.management'), route('admin.platforms.index'));
});

Breadcrumbs::register('admin.platforms.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.platforms.index');
    $breadcrumbs->push(trans('menus.backend.platforms.create'), route('admin.platforms.create'));
});

Breadcrumbs::register('admin.platforms.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.platforms.index');
    $breadcrumbs->push(trans('menus.backend.platforms.edit'), route('admin.platforms.edit', $id));
});
