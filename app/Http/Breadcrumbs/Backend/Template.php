<?php

Breadcrumbs::register('admin.templates.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.templates.management'), route('admin.templates.index'));
});

Breadcrumbs::register('admin.templates.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.templates.index');
    $breadcrumbs->push(trans('menus.backend.templates.create'), route('admin.templates.create'));
});

Breadcrumbs::register('admin.templates.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.templates.index');
    $breadcrumbs->push(trans('menus.backend.templates.edit'), route('admin.templates.edit', $id));
});
