<?php

Breadcrumbs::register('admin.packages.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.packages.management'), route('admin.packages.index'));
});

Breadcrumbs::register('admin.packages.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.packages.index');
    $breadcrumbs->push(trans('menus.backend.packages.create'), route('admin.packages.create'));
});

Breadcrumbs::register('admin.packages.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.packages.index');
    $breadcrumbs->push(trans('menus.backend.packages.edit'), route('admin.packages.edit', $id));
});
