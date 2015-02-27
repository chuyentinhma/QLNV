<?php namespace Impl\Repo;

use Order;
use User;
use Kind;
use Category;
use Unit;
use Purpose;
use Ship;
use Impl\Repo\Order\EloquentOrder;
use Impl\Repo\Ship\EloquentShip;
use Impl\Repo\User\EloquentUser;
use Impl\Repo\Unit\EloquentUnit;
use Impl\Repo\Kind\EloquentKind;
use Impl\Repo\Category\EloquentCategory;
use Impl\Repo\Purpose\EloquentPurpose;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('Impl\Repo\Order\OrderInterface', function($app)
        {
            return  new EloquentOrder(
                new Order
            );
        });

        $app->bind('Impl\Repo\User\UserInterface', function($app)
        {
            return new EloquentUser(
                new User
            );
        });

        $app->bind('Impl\Repo\Unit\UnitInterface', function($app)
        {
            return new EloquentUnit(
                new Unit
            );
        });
        $app->bind('Impl\Repo\Kind\KindInterface', function($app)
        {
            return new EloquentKind(
                new Kind
            );
        });
        $app->bind('Impl\Repo\Category\CategoryInterface', function($app)
        {
            return new EloquentCategory(
                new Category
            );
        });
        $app->bind('Impl\Repo\Purpose\PurposeInterface', function($app)
        {
            return new EloquentPurpose(
                new Purpose
            );
        });
        $app->bind('Impl\Repo\Ship\ShipInterface', function($app)
        {
            return new EloquentShip(
                new Ship
            );
        });
    }

}