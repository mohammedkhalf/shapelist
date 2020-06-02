<?php

Breadcrumbs::register('admin.deliveries.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.deliveries.management'), route('admin.deliveries.index'));
});

Breadcrumbs::register('admin.deliveries.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.deliveries.index');
    $breadcrumbs->push(trans('menus.backend.deliveries.create'), route('admin.deliveries.create'));
});

Breadcrumbs::register('admin.deliveries.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.deliveries.index');
    $breadcrumbs->push(trans('menus.backend.deliveries.edit'), route('admin.deliveries.edit', $id));
});
