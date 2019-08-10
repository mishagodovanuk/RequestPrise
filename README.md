<h1>Smile Request price bundle</h1>

<ul><h3>this bundle contains two modules :</h3> 
    <ul>Catalog</ul>
    <ul>Customer</ul>
</ul>
Catalog module replace standart magento product price, on request button with popup form. From send price request to administration.  
<h5>require: none</h5>

Customer module add administration panel to controll and answer customer requests
<br><h5>require: configured smtp module. mishagodovanuk/request-price-catalog
</h5>
<h1>Installation</h1>
<h4>Run the following commands:</h4>

cd <magento_root>
composer config repositories.mishagodovanuk/request-price-customer vcs git@github.com:mishagodovanuk/RequestPrise.git
composer require mishagodovanuk/request-price-customer:dev-master --prefer-source
bin/magento module:enable Smile_Customer
bin/magento setup:upgrade
for Customer module

<h5>And</h5>
cd <magento_root>
composer config repositories.mishagodovanuk/request-price-catalog vcs git@github.com:mishagodovanuk/RequestPrise.git
composer require mishagodovanuk/request-price-catalog:dev-master --prefer-source
bin/magento module:enable Smile_Catalog
bin/magento setup:upgrade
for Catalog module
     