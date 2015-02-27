<?php namespace Impl\Service\Form;

use Illuminate\Support\ServiceProvider;
use Impl\Service\Form\Order\OrderForm;
use Impl\Service\Form\Order\OrderFormValidator;
use Impl\Service\Form\Ship\ShipForm;
use Impl\Service\Form\Ship\ShipFormValidator;
use Impl\Service\Form\Unit\UnitFormValidator;
use Impl\Service\Form\Unit\UnitForm;
use Impl\Service\Form\Category\CategoryFormValidator;
use Impl\Service\Form\Category\CategoryForm;
use Impl\Service\Form\Kind\KindFormValidator;
use Impl\Service\Form\Kind\KindForm;
use Impl\Service\Form\Purpose\PurposeFormValidator;
use Impl\Service\Form\Purpose\PurposeForm;


class FormServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('Impl\Service\Form\Order\OrderForm', function($app)
        {
            return new OrderForm(new OrderFormValidator($app['validator']), $app->make('Impl\Repo\Order\OrderInterface'));
            
        });
        $app->bind('Impl\Service\Form\Ship\ShipForm', function($app)
        {
            return new ShipForm(new ShipFormValidator($app['validator']), $app->make('Impl\Repo\Ship\ShipInterface'), $app->make('Impl\Repo\Order\OrderInterface'));
            
        });
        $app->bind('Impl\Service\Form\Unit\UnitForm', function($app)
        {
            return new UnitForm(new UnitFormValidator($app['validator']), $app->make('Impl\Repo\Unit\UnitInterface'));
            
        });
        $app->bind('Impl\Service\Form\Category\CategoryForm', function($app)
        {
            return new CategoryForm(new CategoryFormValidator($app['validator']), $app->make('Impl\Repo\Category\CategoryInterface'));
            
        });
        $app->bind('Impl\Service\Form\Kind\KindForm', function($app)
        {
            return new KindForm(new KindFormValidator($app['validator']), $app->make('Impl\Repo\Kind\KindInterface'));
            
        });
        $app->bind('Impl\Service\Form\Purpose\PurposeForm', function($app)
        {
            return new PurposeForm(new PurposeFormValidator($app['validator']), $app->make('Impl\Repo\Purpose\PurposeInterface'));
            
        });
    }

}