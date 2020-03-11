<?php

Breadcrumbs::register('admin.musicsamples.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.musicsamples.management'), route('admin.musicsamples.index'));
});

Breadcrumbs::register('admin.musicsamples.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.musicsamples.index');
    $breadcrumbs->push(trans('menus.backend.musicsamples.create'), route('admin.musicsamples.create'));
});

Breadcrumbs::register('admin.musicsamples.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.musicsamples.index');
    $breadcrumbs->push(trans('menus.backend.musicsamples.edit'), route('admin.musicsamples.edit', $id));
});
