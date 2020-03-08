<?php

Breadcrumbs::register('admin.addons.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.addons.management'), route('admin.addons.index'));
});

Breadcrumbs::register('admin.addons.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.addons.index');
    $breadcrumbs->push(trans('menus.backend.addons.create'), route('admin.addons.create'));
});

Breadcrumbs::register('admin.addons.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.addons.index');
    $breadcrumbs->push(trans('menus.backend.addons.edit'), route('admin.addons.edit', $id));
});
