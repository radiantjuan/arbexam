require('./bootstrap');
require('../../node_modules/chart.js/dist/Chart');
require('../../node_modules/select2/dist/js/select2.full');

if(window.location.href.search('dashboard') !== -1)
{
    require('./dashboard');
}

if(window.location.href.search('users') !== -1)
{
    require('./users');
}

if(window.location.href.search('roles') !== -1)
{
    require('./roles');
}

if(window.location.href.search('category-expenses') !== -1)
{
    require('./expenses');
}


if(window.location.href.search('expenses-category') !== -1)
{
    require('./expenses-cateogry');
}
