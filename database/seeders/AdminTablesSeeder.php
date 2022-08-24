<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // base tables
        \Encore\Admin\Auth\Database\Menu::truncate();
        \Encore\Admin\Auth\Database\Menu::insert(
            [
                [
                    "parent_id" => 0,
                    "order" => 0,
                    "title" => "Helpers",
                    "icon" => "fa-gears",
                    "uri" => "",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 1,
                    "order" => 1,
                    "title" => "Scaffold",
                    "icon" => "fa-keyboard-o",
                    "uri" => "helpers/scaffold",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 1,
                    "order" => 2,
                    "title" => "Database terminal",
                    "icon" => "fa-database",
                    "uri" => "helpers/terminal/database",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 1,
                    "order" => 3,
                    "title" => "Laravel artisan",
                    "icon" => "fa-terminal",
                    "uri" => "helpers/terminal/artisan",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 1,
                    "order" => 4,
                    "title" => "Routes",
                    "icon" => "fa-list-alt",
                    "uri" => "helpers/routes",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 5,
                    "title" => "Media manager",
                    "icon" => "fa-file",
                    "uri" => "media",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 10,
                    "title" => "Brands",
                    "icon" => "fa-list",
                    "uri" => "brands",
                    "permission" => NULL
                ],
                [
                    "parent_id" => 0,
                    "order" => 10,
                    "title" => "Media download",
                    "icon" => "fa-list",
                    "uri" => "media/download",
                    "permission" => NULL
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Permission::truncate();
        \Encore\Admin\Auth\Database\Permission::insert(
            [
                [
                    "name" => "all",
                    "slug" => "all",
                    "http_method" => NULL,
                    "http_path" => "/admin/brands"
                ],
                [
                    "name" => "Admin helpers",
                    "slug" => "ext.helpers",
                    "http_method" => "",
                    "http_path" => "/helpers/*"
                ],
                [
                    "name" => "Media manager",
                    "slug" => "ext.media-manager",
                    "http_method" => "",
                    "http_path" => "/media*"
                ],
                [
                    "name" => "ADDRESSESList",
                    "slug" => "addresses.list",
                    "http_method" => "GET",
                    "http_path" => "/addresses"
                ],
                [
                    "name" => "ADDRESSESView",
                    "slug" => "addresses.view",
                    "http_method" => "GET",
                    "http_path" => "/addresses/*"
                ],
                [
                    "name" => "ADDRESSESCreate",
                    "slug" => "addresses.create",
                    "http_method" => "POST",
                    "http_path" => "/addresses"
                ],
                [
                    "name" => "ADDRESSESEdit",
                    "slug" => "addresses.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/addresses/*"
                ],
                [
                    "name" => "ADDRESSESDelete",
                    "slug" => "addresses.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/addresses/*"
                ],
                [
                    "name" => "ADDRESSESExport",
                    "slug" => "addresses.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "ADDRESSESFilter",
                    "slug" => "addresses.filter",
                    "http_method" => "GET",
                    "http_path" => "/addresses"
                ],
                [
                    "name" => "BLOGSList",
                    "slug" => "blogs.list",
                    "http_method" => "GET",
                    "http_path" => "/blogs"
                ],
                [
                    "name" => "BLOGSView",
                    "slug" => "blogs.view",
                    "http_method" => "GET",
                    "http_path" => "/blogs/*"
                ],
                [
                    "name" => "BLOGSCreate",
                    "slug" => "blogs.create",
                    "http_method" => "POST",
                    "http_path" => "/blogs"
                ],
                [
                    "name" => "BLOGSEdit",
                    "slug" => "blogs.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/blogs/*"
                ],
                [
                    "name" => "BLOGSDelete",
                    "slug" => "blogs.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/blogs/*"
                ],
                [
                    "name" => "BLOGSExport",
                    "slug" => "blogs.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "BLOGSFilter",
                    "slug" => "blogs.filter",
                    "http_method" => "GET",
                    "http_path" => "/blogs"
                ],
                [
                    "name" => "BRANDSList",
                    "slug" => "brands.list",
                    "http_method" => "GET",
                    "http_path" => "/brands"
                ],
                [
                    "name" => "BRANDSView",
                    "slug" => "brands.view",
                    "http_method" => "GET",
                    "http_path" => "/brands/*"
                ],
                [
                    "name" => "BRANDSCreate",
                    "slug" => "brands.create",
                    "http_method" => "POST",
                    "http_path" => "/brands"
                ],
                [
                    "name" => "BRANDSEdit",
                    "slug" => "brands.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/brands/*"
                ],
                [
                    "name" => "BRANDSDelete",
                    "slug" => "brands.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/brands/*"
                ],
                [
                    "name" => "BRANDSExport",
                    "slug" => "brands.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "BRANDSFilter",
                    "slug" => "brands.filter",
                    "http_method" => "GET",
                    "http_path" => "/brands"
                ],
                [
                    "name" => "CATEGORIESList",
                    "slug" => "categories.list",
                    "http_method" => "GET",
                    "http_path" => "/categories"
                ],
                [
                    "name" => "CATEGORIESView",
                    "slug" => "categories.view",
                    "http_method" => "GET",
                    "http_path" => "/categories/*"
                ],
                [
                    "name" => "CATEGORIESCreate",
                    "slug" => "categories.create",
                    "http_method" => "POST",
                    "http_path" => "/categories"
                ],
                [
                    "name" => "CATEGORIESEdit",
                    "slug" => "categories.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/categories/*"
                ],
                [
                    "name" => "CATEGORIESDelete",
                    "slug" => "categories.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/categories/*"
                ],
                [
                    "name" => "CATEGORIESExport",
                    "slug" => "categories.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "CATEGORIESFilter",
                    "slug" => "categories.filter",
                    "http_method" => "GET",
                    "http_path" => "/categories"
                ],
                [
                    "name" => "FAILED-JOBSList",
                    "slug" => "failed-jobs.list",
                    "http_method" => "GET",
                    "http_path" => "/failed-jobs"
                ],
                [
                    "name" => "FAILED-JOBSView",
                    "slug" => "failed-jobs.view",
                    "http_method" => "GET",
                    "http_path" => "/failed-jobs/*"
                ],
                [
                    "name" => "FAILED-JOBSCreate",
                    "slug" => "failed-jobs.create",
                    "http_method" => "POST",
                    "http_path" => "/failed-jobs"
                ],
                [
                    "name" => "FAILED-JOBSEdit",
                    "slug" => "failed-jobs.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/failed-jobs/*"
                ],
                [
                    "name" => "FAILED-JOBSDelete",
                    "slug" => "failed-jobs.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/failed-jobs/*"
                ],
                [
                    "name" => "FAILED-JOBSExport",
                    "slug" => "failed-jobs.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "FAILED-JOBSFilter",
                    "slug" => "failed-jobs.filter",
                    "http_method" => "GET",
                    "http_path" => "/failed-jobs"
                ],
                [
                    "name" => "FAQSList",
                    "slug" => "faqs.list",
                    "http_method" => "GET",
                    "http_path" => "/faqs"
                ],
                [
                    "name" => "FAQSView",
                    "slug" => "faqs.view",
                    "http_method" => "GET",
                    "http_path" => "/faqs/*"
                ],
                [
                    "name" => "FAQSCreate",
                    "slug" => "faqs.create",
                    "http_method" => "POST",
                    "http_path" => "/faqs"
                ],
                [
                    "name" => "FAQSEdit",
                    "slug" => "faqs.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/faqs/*"
                ],
                [
                    "name" => "FAQSDelete",
                    "slug" => "faqs.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/faqs/*"
                ],
                [
                    "name" => "FAQSExport",
                    "slug" => "faqs.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "FAQSFilter",
                    "slug" => "faqs.filter",
                    "http_method" => "GET",
                    "http_path" => "/faqs"
                ],
                [
                    "name" => "FEEDBACKSList",
                    "slug" => "feedbacks.list",
                    "http_method" => "GET",
                    "http_path" => "/feedbacks"
                ],
                [
                    "name" => "FEEDBACKSView",
                    "slug" => "feedbacks.view",
                    "http_method" => "GET",
                    "http_path" => "/feedbacks/*"
                ],
                [
                    "name" => "FEEDBACKSCreate",
                    "slug" => "feedbacks.create",
                    "http_method" => "POST",
                    "http_path" => "/feedbacks"
                ],
                [
                    "name" => "FEEDBACKSEdit",
                    "slug" => "feedbacks.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/feedbacks/*"
                ],
                [
                    "name" => "FEEDBACKSDelete",
                    "slug" => "feedbacks.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/feedbacks/*"
                ],
                [
                    "name" => "FEEDBACKSExport",
                    "slug" => "feedbacks.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "FEEDBACKSFilter",
                    "slug" => "feedbacks.filter",
                    "http_method" => "GET",
                    "http_path" => "/feedbacks"
                ],
                [
                    "name" => "MIGRATIONSList",
                    "slug" => "migrations.list",
                    "http_method" => "GET",
                    "http_path" => "/migrations"
                ],
                [
                    "name" => "MIGRATIONSView",
                    "slug" => "migrations.view",
                    "http_method" => "GET",
                    "http_path" => "/migrations/*"
                ],
                [
                    "name" => "MIGRATIONSCreate",
                    "slug" => "migrations.create",
                    "http_method" => "POST",
                    "http_path" => "/migrations"
                ],
                [
                    "name" => "MIGRATIONSEdit",
                    "slug" => "migrations.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/migrations/*"
                ],
                [
                    "name" => "MIGRATIONSDelete",
                    "slug" => "migrations.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/migrations/*"
                ],
                [
                    "name" => "MIGRATIONSExport",
                    "slug" => "migrations.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "MIGRATIONSFilter",
                    "slug" => "migrations.filter",
                    "http_method" => "GET",
                    "http_path" => "/migrations"
                ],
                [
                    "name" => "NOTIFICATIONSList",
                    "slug" => "notifications.list",
                    "http_method" => "GET",
                    "http_path" => "/notifications"
                ],
                [
                    "name" => "NOTIFICATIONSView",
                    "slug" => "notifications.view",
                    "http_method" => "GET",
                    "http_path" => "/notifications/*"
                ],
                [
                    "name" => "NOTIFICATIONSCreate",
                    "slug" => "notifications.create",
                    "http_method" => "POST",
                    "http_path" => "/notifications"
                ],
                [
                    "name" => "NOTIFICATIONSEdit",
                    "slug" => "notifications.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/notifications/*"
                ],
                [
                    "name" => "NOTIFICATIONSDelete",
                    "slug" => "notifications.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/notifications/*"
                ],
                [
                    "name" => "NOTIFICATIONSExport",
                    "slug" => "notifications.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "NOTIFICATIONSFilter",
                    "slug" => "notifications.filter",
                    "http_method" => "GET",
                    "http_path" => "/notifications"
                ],
                [
                    "name" => "ORDERSList",
                    "slug" => "orders.list",
                    "http_method" => "GET",
                    "http_path" => "/orders"
                ],
                [
                    "name" => "ORDERSView",
                    "slug" => "orders.view",
                    "http_method" => "GET",
                    "http_path" => "/orders/*"
                ],
                [
                    "name" => "ORDERSCreate",
                    "slug" => "orders.create",
                    "http_method" => "POST",
                    "http_path" => "/orders"
                ],
                [
                    "name" => "ORDERSEdit",
                    "slug" => "orders.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/orders/*"
                ],
                [
                    "name" => "ORDERSDelete",
                    "slug" => "orders.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/orders/*"
                ],
                [
                    "name" => "ORDERSExport",
                    "slug" => "orders.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "ORDERSFilter",
                    "slug" => "orders.filter",
                    "http_method" => "GET",
                    "http_path" => "/orders"
                ],
                [
                    "name" => "PASSWORD-RESETSList",
                    "slug" => "password-resets.list",
                    "http_method" => "GET",
                    "http_path" => "/password-resets"
                ],
                [
                    "name" => "PASSWORD-RESETSView",
                    "slug" => "password-resets.view",
                    "http_method" => "GET",
                    "http_path" => "/password-resets/*"
                ],
                [
                    "name" => "PASSWORD-RESETSCreate",
                    "slug" => "password-resets.create",
                    "http_method" => "POST",
                    "http_path" => "/password-resets"
                ],
                [
                    "name" => "PASSWORD-RESETSEdit",
                    "slug" => "password-resets.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/password-resets/*"
                ],
                [
                    "name" => "PASSWORD-RESETSDelete",
                    "slug" => "password-resets.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/password-resets/*"
                ],
                [
                    "name" => "PASSWORD-RESETSExport",
                    "slug" => "password-resets.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "PASSWORD-RESETSFilter",
                    "slug" => "password-resets.filter",
                    "http_method" => "GET",
                    "http_path" => "/password-resets"
                ],
                [
                    "name" => "PERSONAL-ACCESS-TOKENSList",
                    "slug" => "personal-access-tokens.list",
                    "http_method" => "GET",
                    "http_path" => "/personal-access-tokens"
                ],
                [
                    "name" => "PERSONAL-ACCESS-TOKENSView",
                    "slug" => "personal-access-tokens.view",
                    "http_method" => "GET",
                    "http_path" => "/personal-access-tokens/*"
                ],
                [
                    "name" => "PERSONAL-ACCESS-TOKENSCreate",
                    "slug" => "personal-access-tokens.create",
                    "http_method" => "POST",
                    "http_path" => "/personal-access-tokens"
                ],
                [
                    "name" => "PERSONAL-ACCESS-TOKENSEdit",
                    "slug" => "personal-access-tokens.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/personal-access-tokens/*"
                ],
                [
                    "name" => "PERSONAL-ACCESS-TOKENSDelete",
                    "slug" => "personal-access-tokens.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/personal-access-tokens/*"
                ],
                [
                    "name" => "PERSONAL-ACCESS-TOKENSExport",
                    "slug" => "personal-access-tokens.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "PERSONAL-ACCESS-TOKENSFilter",
                    "slug" => "personal-access-tokens.filter",
                    "http_method" => "GET",
                    "http_path" => "/personal-access-tokens"
                ],
                [
                    "name" => "PORODUCT-RATINGSList",
                    "slug" => "poroduct-ratings.list",
                    "http_method" => "GET",
                    "http_path" => "/poroduct-ratings"
                ],
                [
                    "name" => "PORODUCT-RATINGSView",
                    "slug" => "poroduct-ratings.view",
                    "http_method" => "GET",
                    "http_path" => "/poroduct-ratings/*"
                ],
                [
                    "name" => "PORODUCT-RATINGSCreate",
                    "slug" => "poroduct-ratings.create",
                    "http_method" => "POST",
                    "http_path" => "/poroduct-ratings"
                ],
                [
                    "name" => "PORODUCT-RATINGSEdit",
                    "slug" => "poroduct-ratings.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/poroduct-ratings/*"
                ],
                [
                    "name" => "PORODUCT-RATINGSDelete",
                    "slug" => "poroduct-ratings.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/poroduct-ratings/*"
                ],
                [
                    "name" => "PORODUCT-RATINGSExport",
                    "slug" => "poroduct-ratings.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "PORODUCT-RATINGSFilter",
                    "slug" => "poroduct-ratings.filter",
                    "http_method" => "GET",
                    "http_path" => "/poroduct-ratings"
                ],
                [
                    "name" => "PORODUCT-SERIESList",
                    "slug" => "poroduct-series.list",
                    "http_method" => "GET",
                    "http_path" => "/poroduct-series"
                ],
                [
                    "name" => "PORODUCT-SERIESView",
                    "slug" => "poroduct-series.view",
                    "http_method" => "GET",
                    "http_path" => "/poroduct-series/*"
                ],
                [
                    "name" => "PORODUCT-SERIESCreate",
                    "slug" => "poroduct-series.create",
                    "http_method" => "POST",
                    "http_path" => "/poroduct-series"
                ],
                [
                    "name" => "PORODUCT-SERIESEdit",
                    "slug" => "poroduct-series.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/poroduct-series/*"
                ],
                [
                    "name" => "PORODUCT-SERIESDelete",
                    "slug" => "poroduct-series.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/poroduct-series/*"
                ],
                [
                    "name" => "PORODUCT-SERIESExport",
                    "slug" => "poroduct-series.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "PORODUCT-SERIESFilter",
                    "slug" => "poroduct-series.filter",
                    "http_method" => "GET",
                    "http_path" => "/poroduct-series"
                ],
                [
                    "name" => "PRODUCT-IMAGESList",
                    "slug" => "product-images.list",
                    "http_method" => "GET",
                    "http_path" => "/product-images"
                ],
                [
                    "name" => "PRODUCT-IMAGESView",
                    "slug" => "product-images.view",
                    "http_method" => "GET",
                    "http_path" => "/product-images/*"
                ],
                [
                    "name" => "PRODUCT-IMAGESCreate",
                    "slug" => "product-images.create",
                    "http_method" => "POST",
                    "http_path" => "/product-images"
                ],
                [
                    "name" => "PRODUCT-IMAGESEdit",
                    "slug" => "product-images.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/product-images/*"
                ],
                [
                    "name" => "PRODUCT-IMAGESDelete",
                    "slug" => "product-images.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/product-images/*"
                ],
                [
                    "name" => "PRODUCT-IMAGESExport",
                    "slug" => "product-images.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "PRODUCT-IMAGESFilter",
                    "slug" => "product-images.filter",
                    "http_method" => "GET",
                    "http_path" => "/product-images"
                ],
                [
                    "name" => "PRODUCTSList",
                    "slug" => "products.list",
                    "http_method" => "GET",
                    "http_path" => "/products"
                ],
                [
                    "name" => "PRODUCTSView",
                    "slug" => "products.view",
                    "http_method" => "GET",
                    "http_path" => "/products/*"
                ],
                [
                    "name" => "PRODUCTSCreate",
                    "slug" => "products.create",
                    "http_method" => "POST",
                    "http_path" => "/products"
                ],
                [
                    "name" => "PRODUCTSEdit",
                    "slug" => "products.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/products/*"
                ],
                [
                    "name" => "PRODUCTSDelete",
                    "slug" => "products.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/products/*"
                ],
                [
                    "name" => "PRODUCTSExport",
                    "slug" => "products.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "PRODUCTSFilter",
                    "slug" => "products.filter",
                    "http_method" => "GET",
                    "http_path" => "/products"
                ],
                [
                    "name" => "PROFILESList",
                    "slug" => "profiles.list",
                    "http_method" => "GET",
                    "http_path" => "/profiles"
                ],
                [
                    "name" => "PROFILESView",
                    "slug" => "profiles.view",
                    "http_method" => "GET",
                    "http_path" => "/profiles/*"
                ],
                [
                    "name" => "PROFILESCreate",
                    "slug" => "profiles.create",
                    "http_method" => "POST",
                    "http_path" => "/profiles"
                ],
                [
                    "name" => "PROFILESEdit",
                    "slug" => "profiles.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/profiles/*"
                ],
                [
                    "name" => "PROFILESDelete",
                    "slug" => "profiles.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/profiles/*"
                ],
                [
                    "name" => "PROFILESExport",
                    "slug" => "profiles.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "PROFILESFilter",
                    "slug" => "profiles.filter",
                    "http_method" => "GET",
                    "http_path" => "/profiles"
                ],
                [
                    "name" => "PROPRTIESList",
                    "slug" => "proprties.list",
                    "http_method" => "GET",
                    "http_path" => "/proprties"
                ],
                [
                    "name" => "PROPRTIESView",
                    "slug" => "proprties.view",
                    "http_method" => "GET",
                    "http_path" => "/proprties/*"
                ],
                [
                    "name" => "PROPRTIESCreate",
                    "slug" => "proprties.create",
                    "http_method" => "POST",
                    "http_path" => "/proprties"
                ],
                [
                    "name" => "PROPRTIESEdit",
                    "slug" => "proprties.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/proprties/*"
                ],
                [
                    "name" => "PROPRTIESDelete",
                    "slug" => "proprties.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/proprties/*"
                ],
                [
                    "name" => "PROPRTIESExport",
                    "slug" => "proprties.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "PROPRTIESFilter",
                    "slug" => "proprties.filter",
                    "http_method" => "GET",
                    "http_path" => "/proprties"
                ],
                [
                    "name" => "QUERIESList",
                    "slug" => "queries.list",
                    "http_method" => "GET",
                    "http_path" => "/queries"
                ],
                [
                    "name" => "QUERIESView",
                    "slug" => "queries.view",
                    "http_method" => "GET",
                    "http_path" => "/queries/*"
                ],
                [
                    "name" => "QUERIESCreate",
                    "slug" => "queries.create",
                    "http_method" => "POST",
                    "http_path" => "/queries"
                ],
                [
                    "name" => "QUERIESEdit",
                    "slug" => "queries.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/queries/*"
                ],
                [
                    "name" => "QUERIESDelete",
                    "slug" => "queries.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/queries/*"
                ],
                [
                    "name" => "QUERIESExport",
                    "slug" => "queries.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "QUERIESFilter",
                    "slug" => "queries.filter",
                    "http_method" => "GET",
                    "http_path" => "/queries"
                ],
                [
                    "name" => "USERSList",
                    "slug" => "users.list",
                    "http_method" => "GET",
                    "http_path" => "/users"
                ],
                [
                    "name" => "USERSView",
                    "slug" => "users.view",
                    "http_method" => "GET",
                    "http_path" => "/users/*"
                ],
                [
                    "name" => "USERSCreate",
                    "slug" => "users.create",
                    "http_method" => "POST",
                    "http_path" => "/users"
                ],
                [
                    "name" => "USERSEdit",
                    "slug" => "users.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/users/*"
                ],
                [
                    "name" => "USERSDelete",
                    "slug" => "users.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/users/*"
                ],
                [
                    "name" => "USERSExport",
                    "slug" => "users.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "USERSFilter",
                    "slug" => "users.filter",
                    "http_method" => "GET",
                    "http_path" => "/users"
                ],
                [
                    "name" => "WIDGETSList",
                    "slug" => "widgets.list",
                    "http_method" => "GET",
                    "http_path" => "/widgets"
                ],
                [
                    "name" => "WIDGETSView",
                    "slug" => "widgets.view",
                    "http_method" => "GET",
                    "http_path" => "/widgets/*"
                ],
                [
                    "name" => "WIDGETSCreate",
                    "slug" => "widgets.create",
                    "http_method" => "POST",
                    "http_path" => "/widgets"
                ],
                [
                    "name" => "WIDGETSEdit",
                    "slug" => "widgets.edit",
                    "http_method" => "PUT,PATCH",
                    "http_path" => "/widgets/*"
                ],
                [
                    "name" => "WIDGETSDelete",
                    "slug" => "widgets.delete",
                    "http_method" => "DELETE",
                    "http_path" => "/widgets/*"
                ],
                [
                    "name" => "WIDGETSExport",
                    "slug" => "widgets.export",
                    "http_method" => "GET",
                    "http_path" => ""
                ],
                [
                    "name" => "WIDGETSFilter",
                    "slug" => "widgets.filter",
                    "http_method" => "GET",
                    "http_path" => "/widgets"
                ]
            ]
        );

        \Encore\Admin\Auth\Database\Role::truncate();
        \Encore\Admin\Auth\Database\Role::insert(
            [
                [
                    "name" => "administrator",
                    "slug" => "administrator"
                ]
            ]
        );

        // pivot tables
        DB::table('admin_role_menu')->truncate();
        DB::table('admin_role_menu')->insert(
            [

            ]
        );

        DB::table('admin_role_permissions')->truncate();
        DB::table('admin_role_permissions')->insert(
            [
                [
                    "role_id" => 1,
                    "permission_id" => 1
                ]
            ]
        );

        // finish
    }
}
