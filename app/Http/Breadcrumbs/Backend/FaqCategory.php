<?php

Breadcrumbs::register('admin.faqcategories.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.faqcategories.management'), route('admin.faqcategories.index'));
});

Breadcrumbs::register('admin.faqcategories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.faqcategories.index');
    $breadcrumbs->push(trans('menus.backend.faqcategories.create'), route('admin.faqcategories.create'));
});

Breadcrumbs::register('admin.faqcategories.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.faqcategories.index');
    $breadcrumbs->push(trans('menus.backend.faqcategories.edit'), route('admin.faqcategories.edit', $id));
});
