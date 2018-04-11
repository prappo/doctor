<?php

use App\Http\Controllers\CoreController;

Route::get('/', function () {
    return redirect('home');
});

Route::any('/hook', 'Hook@fb');

Route::post('/slack/hook', 'Hook@slack');
Route::any('/schedule/fire', 'ScheduleController@fire');

Route::group(['middleware' => 'web'], function () {
    Route::auth();


    Route::group(['middleware' => 'auth'], function () {

        Route::resource('/contact', 'ContactController');

        Route::get('/p', 'Prappo@prappo');
        Route::get('/home', 'HomeController@index');
        Route::get('/write', 'Write@index');
        Route::get('/posttest', 'Write@postTest');

        // OAuth 2 callback urls
        Route::get('/fbconnect', 'Settings@fbconnect');

        // settings pages
        Route::get('/settings', 'Settings@index');
        Route::get('/settings/notifications', 'Settings@notifyIndex');
        Route::get('/settings/config', 'Settings@configIndex');
        Route::get('/reports', 'Reports@index');

        Route::get('/followers', 'FollowersController@index');
        Route::get('/gettwfoll', 'FollowersController@showTwFollowers');
        Route::get('/showalltwfollowers', 'FollowersController@showAllTwFollowers');

        // dashboard activities
        Route::get('/fblikes', 'HomeController@fbLikes');
        Route::get('/twfollowers', 'HomeController@twFollowers');
        Route::get('/tufollowers', 'HomeController@tuFollowers');
        Route::get('/liTotalCompanies', 'HomeController@liTotalCompanies');
        Route::get('/companyFollowers', 'HomeController@companyFollowers');
        Route::get('/liCompanyUpdates', 'HomeController@liCompanyUpdates');
        Route::get('/liPostedJobs', 'HomeController@liPostedJobs');

        Route::get('/allpost', 'AllpostController@index');

        Route::get('/facebook', 'FacebookController@index');

//        Twitter

        Route::get('/twitter', 'TwitterController@index');
        Route::post('/twitter/retweet', 'TwitterController@retweet');
        Route::post('/twitter/message', 'TwitterController@twSendMsg');
        Route::get('/twitter/masssend', 'TwitterController@massSend');
        Route::post('/twitter/masssend/action', 'TwitterController@massMessageSend');
        Route::get('/twitter/message/send', 'TwitterController@sendMessage');
        Route::post('/twitter/reply', 'TwitterController@twReply');
        Route::post('/twitter/autoretweet', 'TwitterController@autoRetweet');
        Route::get('/twitter/autoretweet', 'TwitterController@autoRetweetIndex');
        Route::get('/twitter/autoreply', 'TwitterController@autoReplyIndex');
        Route::post('/twitter/autoreply', 'TwitterController@autoReply');
        Route::post('/twitter/autoreplyall', 'TwitterController@autoReplyAll');
        Route::get('/twitter/mega/masssend', 'TwitterController@massMegaSendIndex');

        Route::get('/tumblr', 'TumblrController@index');
        Route::get('/wordpress', 'WordpressController@index');

        Route::post('/wpwrite', 'Write@wpWrite');
        Route::post('/twwrite', 'Write@twWrite');
        Route::post('/fbwrite', 'Write@fbWrite');
        Route::post('/fbgwrite', 'Write@fbgwrite');
        Route::post('/tuwrite', 'Write@tuWrite');
        Route::post('/linkedin/share', 'write@liWrite');
        Route::post('/post/save', 'Write@postSave');

        Route::post('/delpost', 'Write@delPost');
        Route::post('/delallpost', 'AllpostController@delAll');
        Route::post('/delfromall', 'AllpostController@delFromAll');

        //update settings
        Route::post('/wpsave', 'Settings@wpSave');
        Route::post('/fbsave', 'Settings@fbSave');
        Route::post('/twsave', 'Settings@twSave');
        Route::post('/tusave', 'Settings@tuSave');
        Route::post('/skypesave', 'Settings@skypeSave');
        Route::post('/lisave', 'Settings@liSave');
        Route::post('/insave', 'Settings@inSave');
        Route::post('/settings/notifications', 'Settings@notifySave');
        Route::post('/save/fb/bot/config', 'Settings@fbBotConfigSave');
        Route::post('/settings/update/theme', 'Settings@updateTheme');
        Route::post('/pinsave', 'Settings@pinSave');

        // deleting
        Route::post('/fbdel', 'FacebookController@fbDelete');
        Route::post('/wpdel', 'WordpressController@wpDelete');

        // commenting
        Route::post('/fbcom', 'FacebookController@fbComment');

        // editing
        Route::post('/fbedit', 'FacebookController@fbEdit');
        // delete twitter post
        Route::post('/twdel', 'Write@twDelete');
        // delete tumblr post
        Route::post('/tudel', 'Write@tuDelete');
        Route::post('/tureblog', 'Write@tuReblog');

//        Image upload

        Route::post('/iup', 'ImageUpload@iup');
        Route::post('/content/upload', 'ImageUpload@contentUpload');
        Route::post('/content/list', 'ImageUpload@showImages');
        Route::post('/content/delete', 'ImageUpload@deleteImage');

        Route::post('/addschedule', 'ScheduleController@addSchedule');
        Route::get('/schedules', 'ScheduleController@index');
        Route::get('/scheduleslog', 'OptLogs@index');

        Route::get('/schedule/day', 'ScheduleController@scheduleDay');
        Route::post('/schedule/filter', 'ScheduleController@filter');
        Route::get('/schedule/filter/week', 'ScheduleController@filterThisWeek');
        Route::get('/schedule/filter/month', 'ScheduleController@filterThisMonth');
        Route::get('/schedule/filter/all', 'ScheduleController@allDays');
        Route::post('/schedule/time/update', 'ScheduleController@timeUpdate');

        Route::post('/logdel', 'OptLogs@logDel');
        Route::post('/alllogdel', 'OptLogs@delAll');
        Route::post('/sdel', 'ScheduleController@sdel');
        Route::post('/sedit', 'ScheduleController@sedit');


        // Report specific routes
        Route::get('/fbreport', 'FacebookController@fbReport');
        Route::get('/fbreport/{pageId}', 'FacebookController@fbReportSingle');

        Route::get('/fbgroups', 'FacebookController@fbGroupIndex');
        Route::get('/tusync', 'Settings@tuSync');
        Route::get('/fbmassgrouppost', 'MassFbGroup@index');
        Route::post('/savepublicgroup', 'MassFbGroup@saveGroup');
        Route::post('/fbmassgroupdel', 'MassFbGroup@deleteGroup');
        Route::post('/posttomassgroup', 'MassFbGroup@massPost');

        Route::get('/conversations', 'Conversation@index');
        Route::get('/conversations/{pageId}', 'Conversation@getConversations');
        Route::get('/conversations/{pageId}/{cId}', 'Conversation@inbox');
        Route::get('/conversations/message/{pageId}/{mId}', 'Conversation@message');
        Route::get('/ajaxchat/{pageId}/{cId}', 'Conversation@ajaxGetConversations');
        Route::post('/chat', 'Conversation@chat');

        Route::get('/masssend/{pageId}', 'FacebookController@massSend');
        Route::get('/masssend', 'FacebookController@massSendIndex');
        Route::post('/massreplay', 'FacebookController@massReplay');
        Route::get('/facebook/masscomment', 'FacebookController@massComment');
        Route::post('/facebook/masscomment', 'FacebookController@massCommentAction');
        Route::post('/facebook/page/masscomment', 'FacebookController@massCommentPageAction');

        Route::post('/facebook/addpublicpage', 'FacebookController@publicPageAdd');
        Route::post('/delete/fbpublicpage', 'FacebookController@deletePage');


        Route::get('/fb/bot', 'ChatBotController@fb');
        Route::get('/slack/bot', 'ChatBotController@slack');
        Route::post('/fb/addquestion', 'ChatBotController@addQuestion'); // fb bot
        Route::post('/fb/delquestion', 'ChatBotController@delQuestion'); // fb bot
        Route::post('/add-slack-question', 'ChatBotController@addSlackQuestion');
        Route::post('/delete-slack-question', 'ChatBotController@deleteSlackQuestion');
        Route::post('/update-slack-bot-config', 'ChatBotController@updateBotConfig');

        Route::post('/langsave', 'Settings@lang');

        Route::get('/scraper', 'Scraper@index');
        Route::post('/scraper', 'FacebookController@scraper');

        // Notifications specific routes
        Route::post('/notify', 'Notify@insert');
        Route::get('/notify', 'Notify@show');
        Route::post('/allnotifydel', 'Notify@delAll');
        Route::get('/tw/scraper', 'Scraper@twScraper');
        Route::post('/tw/scraper', 'Scraper@twitterScrapper');


        // plugins
        Route::get('/plugin/list', 'Plugins@index');
        Route::get('/plugin/test', 'Plugins@test');
        Route::get('/plugin/add', 'Plugins@addPlugin');
        Route::post('/plugin/action', 'Plugins@action');
        Route::post('/plugin/upload', 'Plugins@upload');
        Route::post('/plugin/active/for/user', 'Plugins@activePluginForUser');

        // shop

        Route::get('/shop', 'ShopController@index');
        Route::get('/shop/plugins', 'ShopController@getPlugins');

//        pinterest rotues
        Route::get('/pinterest', 'PinterestController@index');
        Route::get('/pinterest/scraper', 'PinterestController@scraperIndex');
        Route::post('/pinterest/search', 'PinterestController@scraper');
        Route::get('/pinterest/home', 'PinterestController@home');
        Route::post('/pinterest/write', 'PinterestController@write');

//        virtual assistant routes
//
//        Route::post('/getexmsg','SettingsController@getExMessage');
//        Route::get('/spam/logs','SpamController@logs');
//        Route::post('/spam/deleteall','SpamController@deleteLogs');
//        Route::resource('/facebook','FacebookController');
//        Route::resource('/settings','SettingsController');
//        Route::resource('/comment','Comments');
//        Route::resource('/message','Messages');
//        Route::resource('/spam','SpamController');
//        Route::resource('/code','ShortCodeController');
//        Route::resource('/notification','NotificationController');
//        Route::resource('/spam','SpamController');

        Route::get('/extend', 'ExtendController@index');
        Route::get('/extend/{pageId}', 'ExtendController@page');

        Route::get('/capture', 'CaptureController@index');
        Route::post('/capture/get/info', 'CaptureController@getInfo');
        Route::post('/capture/get/feed', 'CaptureController@getFeed');
        Route::post('/capture/get/feed/custom', 'CaptureController@getFeedCustom');


        Route::get('/campaign', 'campaignController@index');
        Route::get('/campaign/page/{pageId}', 'campaignController@pageUsers');
        Route::get('/campaign/testmessage', 'campaignController@testMessage');

        Route::post('/campaign/list/update', 'campaignController@updateCustomCampaignList');
        Route::post('/campaign/add/to/custom/campaign', 'campaignController@addToQueue');
        Route::post('/campaign/submit/instant', 'campaignController@submitInstant');
        Route::post('/campaign/submit/custom/instant', 'campaignController@submitCustomInstant');
        Route::post('/campaign/send/message/single', 'campaignController@sendSingleMessage');
        Route::post('/campaign/schedule/all', 'campaignController@campaignScheduleAll');


        Route::get('/monitor', 'Monitor@pageMonitorIndex');

    });


});
