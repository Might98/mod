<?php

/*
	Слив by Relevant-Craft.SU

	=========================

	СТАНЬ ХАКЕРОМ
	В ОДИН КЛИК!
*/

	if(!defined('INCLUDE_CHECK')) die("You don't have permissions to run this");
	$skinpath = "http://***.ru/skins/%s.png";///путь к скинам
	$cloakpath = "http://***.ru/cloaks/%s.png";///путь к плащам
	///Настройки MySQL///
	$mysql = array(
		'server' => '',//хост
		'username' => '',//имя пользователя
		'password' => '',//пароль
		'db' => '',//имя базы данных
		'port' => '3306',///порт соединения
		'charset' => 'UTF8'///кодировка вывода из БД (UTF8 или CP1251)
	);
	///Настройка лаунчера///
    $prefs = array(
		///настройки///
        "main" => array(
		    "title" => "Kek Launcher", //заголовок лаунчера
			"ingame" => "Kek | %s",//заголовок окна игры
		    "dir" => ".Kek",//корневая папка игры
			"site" =>  $_SERVER["SERVER_NAME"]."/mine",//папка с вебчастью
			///Без надобности - не трогать///
			"progs" => "goldencreeper,ceerror,pia3333,downforce,cheatengine,procexp,sysinternals,inclasstranslator,wpepro,httpanaly,jdgui,intercepter,batnik,po100b,xvi32,hacked,doos,zhyk,mmoru,HxD,clicker,autoclick,rsclient,easyscript,cffteam",
            "dirs" => "texturepacks,resourcepacks,resources,saves",//папки, которые не проверяются лаунчером
            "excl" => "killaura,kradxn,taehc,ddoss,kodehawa,freecam,speedhack,wallhack,ellian,xrayRender,speedMiner,antiAFK,X-Ray",//ЧС читов
            "fails" => "classpath,loader,zipfile,jarfile,stringbuffer,file.class,inputstream,class.class,digest,system,runtime",//ЧС универсальных обходов
            "formats" => "zip,jar,dll,litemod,exe,class,so,dylib,jnilib,bat,pkg",//проверяемые для удаления типы файлов
			"locked" => "zip,jar,litemod,exe,class",//типы файлов, для которых блокируется запись
			///Ниже можно, вообще, не трогать///
			"assets" => "assets",
			"assetmode" => "1",///режим assets 0-выключить умную загрузку, 1-грузить в главном потоке, 2 - грузить в фоне
			"assetver" => "1.2,1.3,1.4,1.5,1.6",///версии, на которых невозможна загрузка assets (1.6 добавлен, т.к. будет юзаться assets.pkg)
            "bin" => "bin",
            "config" => "config.cfg",
            "libs" => "libs",
			"libraries" => "libraries",
			"versions" => "versions",
            "natives" => "natives",
            "script" => "launch.php",
        ),
		///сервера (название, ip, port, папка)
        "servers" => array(
		  'Kek,Kek.38.13.3,25565,kek,1.6.4',
		  'Kek,Kek.38.13.3,25565,kek,1.6.4',
		  'Kek,Kek.38.13.3,25565,kek,1.6.4',
		  'Kek,Kek.38.13.3,25565,kek,1.6.4',
        ),
		///Радиостанции (название, ссылка)
        "stations" => array(
            "Европа +,http://radio.north.kz:8000/europaplus-128",
            "Зайцев FM,http://radio.zaycev.fm:8999/ZaycevFM(128)",
            "Record Club,http://radio.muff.kiev.ua:8000/rrclub",
            "Record DubStep,http://radio.muff.kiev.ua:8000/rrdub",
            "Rock FM,http://mp3.nashe.ru/rock-128.mp3",
        ),
		///Патчи (не трогать)///
		"patches" => array(
			///Системные патчи///
			///'new:>start:>net.minecraft.launchwrapper.LaunchClassLoader:>runTransformers:>null:>{$args[0] = (byte[]) ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("transform0", new Class[]{String.class, String.class, byte[].class}).invoke(null, new Object[]{$args[0],$args[1],$args[2]});}:>null',
			'new:>add:>net.minecraft.launchwrapper.LaunchClassLoader:>runTransformers:>null:>{return (byte[]) ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("transform", new Class[]{String.class, String.class, byte[].class}).invoke(null, new Object[]{$args[0],$args[1],$args[2]});}:>null',
			'new:>start:>net.minecraft.launchwrapper.Launch:>launch:>null:>{ClassLoader.getSystemClassLoader().loadClass("net.minecraft.Launcher").getDeclaredMethod("getnew",new Class[0]).invoke(null,new Object[0]);}:>null',
			'old:>add:>cpw.mods.fml.relauncher.RelaunchClassLoader:>runTransformers:>null:>{return (byte[]) ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("transform", new Class[]{String.class, String.class, byte[].class}).invoke(null, new Object[]{$args[0],$args[0],$args[1]});}:>null',
			///Патчи защиты///
			'1.4.6,1.4.7:>set:>ayh:>a:>java.lang.String,java.lang.String,java.lang.String:>{String s2 = null; try{s2 = (String) ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("auth", new Class[]{String.class, ClassLoader.class}).invoke(null, new Object[]{$args[2],ayh.class.getClassLoader()});} catch (Exception e) {e.printStackTrace();s2 = "Ошибка авторизации!";} return s2;}:>null',
			'1.5.1,1.5.2:>set:>bdk:>a:>java.lang.String,java.lang.String,java.lang.String:>{String s2 = null; try{s2 = (String) ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("auth", new Class[]{String.class, ClassLoader.class}).invoke(null, new Object[]{$args[2],bdk.class.getClassLoader()});} catch (Exception e) {e.printStackTrace();s2 = "Ошибка авторизации!";} return s2;}:>null',
			'1.6.1,1.6.2,1.6.4:>set:>bcw:>func_72550_a:>java.lang.String,java.lang.String,java.lang.String:>{String s2 = null; try{s2 = (String) ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("auth", new Class[]{String.class, ClassLoader.class}).invoke(null, new Object[]{$args[2],net.minecraft.client.multiplayer.NetClientHandler.class.getClassLoader()});} catch (Exception e) {e.printStackTrace();s2 = "Ошибка авторизации!";} return s2;}:>null',
			'1.6.1,1.6.2,1.6.4,1.7.2,1.7.10,1.8:>start:>org.lwjgl.opengl.Display:>setTitle:>java.lang.String:>{$1=System.getProperty("minecraft.title","Minecraft");}:>null',
			'1.7.1,1.7.2,1.7.4,1.7.5,1.7.9,1.7.10,1.8:>set:>com.mojang.authlib.yggdrasil.YggdrasilMinecraftSessionService:>joinServer:>null:>{try{ClassLoader.getSystemClassLoader().loadClass("net.k773.Auth").getDeclaredMethod("auth", new Class[]{String.class, ClassLoader.class}).invoke(null, new Object[]{$args[2],com.mojang.authlib.GameProfile.class.getClassLoader()});} catch (Exception e) {e.printStackTrace();} try{String url = (String) ClassLoader.getSystemClassLoader().loadClass("net.k773.Tools").getDeclaredMethod("createurl", new Class[]{String.class}).invoke(null, new Object[]{"j.php?user="+$args[1]}); getAuthenticationService().makeRequest(new java.net.URL(url), null, com.mojang.authlib.yggdrasil.response.Response.class);} catch (Exception e) {e.printStackTrace();}}:>com.mojang.authlib.GameProfile,com.mojang.authlib.yggdrasil.response.Response',
			///Патчи скинов для 1.6.x/1.7.2///
			//'1.6.1,1.6.2,1.6.4,1.7.2:>set:>net.minecraft.client.entity.AbstractClientPlayer:>func_110300_d:>java.lang.String:>{return ("'.$skinpath.'").replace("%s",(String) $args[0]);}:>null',
			//'1.6.1,1.6.2,1.6.4,1.7.2:>set:>net.minecraft.client.entity.AbstractClientPlayer:>func_110308_e:>java.lang.String:>{return ("'.$cloakpath.'").replace("%s",(String) $args[0]);}:>null',
			///Прочие патчи///
			'1.4.6,1.4.7,1.5.2:>set:>cpw.mods.fml.common.discovery.ModDiscoverer:>findClasspathMods:>cpw.mods.fml.common.ModClassLoader:>{return;}:>method',
			'old:>add:>cpw.mods.fml.relauncher.FMLRelauncher:>showWindow:>null:>{popupWindow.setVisible(false);}:>method',
		),
    );
	///Настройки дизайна///
 $design = array(
        'banners' => array(
            '880,29,204,34,,gray,banners/logo,14,http://,1,',
        ),
        'button' => array(
            'close' => '822,18,11,11,,gray,close,16,',
            'closeingame' => '278,244,18,18,,white,closemin,16',
            'hide' => '802,11,9,18,,gray,hide,16,',
            'hideingame' => '262,244,18,18,,white,hidemin,16',
            'memory' => '651,11,125,23,Выбор ОЗУ,black,memory,16,',
            'news' => '14,61,276,306,http://site.ru,white,newsbg,0,',
            'online' => '537,76,297,306,http://site.ru,white,newsbg,0,',
            'togame' => '394,454,190,40,Начать игру,white,button,18,',
        ),
        'checkbox' => array(
            'autoenter' => '194,449,200,17, Автозаход на сервер,gray,checkbox,14,',
            'conf' => '605,440,200,17, Сбросить конфиги,gray,checkbox,14,',
            'fullscreen' => '605,461,200,17, Полноэкранный режим,gray,checkbox,14,',
            'play' => '662,550,32,26,,gray,radio,14,',
            'playingame' => '6,263,32,26,,gray,radio,14',
            'savepass' => '194,430,193,17, Запомнить пароль,gray,checkbox,14,',
            'upd' => '194,469,196,17, Перекачать клиент,gray,checkbox,14,',
        ),
        'dropdown' => array(
            'servers' => '395,424,190,26,gray,servers,14,1,',
            'stations' => '679,540,137,26,gray,servers,14,1,',
            'stationsingame' => '40,263,148,26,gray,servers,14,1',
        ),
        'elements' => array(
            'assetloader' => '4,4,292,42,292,10,-100,20,',
            'frame' => '850,500,background',
            'loadbar' => '11,377,830,42,364,16,20,65,',
            'title' => '46,7,599,30,16,Kek Launcher by K773,',
        ),
        'slider' => array(
            'volume' => '808,545,88,26,',
            'volumeingame' => '190,263,100,26',
        ),
        'textfield' => array(
            'login' => '7,427,184,29,gray,login,16,30,',
            'pass' => '7,457,184,29,gray,pass,16,30,',
        ),
    );
	
	///Таблица авторизации движка///
	$db_table       	= "dle_users"; //Таблица с пользователями
	$column_User  		= "name"; //Колонка с именами пользователей
	$column_Pass  		= "password"; //Колонка с паролями пользователей
	$db_tableOther 		= 'xf_user_authenticate'; //Дополнительная таблица для XenForo, не трогайте
	$column_Salt  	= 'members_pass_salt'; //Настраивается для IPB и vBulletin: , IPB - members_pass_salt, vBulletin - salt
	
	///Таблица авторизации лаунчера///
	$db_auth       		= "auth"; //Таблица авторизации
	$column_id  		= "id";///колонка id: varchar(32)
	$column_login  		= "login";///колонка логина: varchar(32)
	$column_os  		= "os";///колонка логина: varchar(32)
	$column_arch  		= "arch";///колонка логина: varchar(32)
	$column_salt  		= "salt";///колонка соль авторизации тип: varchar(32)
	$column_Time  		= "timestamp";///колонка времени тип: varchar(32)
	$column_Group 		= "user_group";///колонка группы dle (для привязки) тип: varchar(32)
	$column_HWID  		= "hwid";////колонка id железа тип: varchar(32)
	$column_HWID2  		= "hwid2";////колонка id железа тип: varchar(32)
	$column_SesId	 	= "session"; ///колонка сессии тип: varchar(32)
	$column_Server		= "server"; ///колонка id сервера тип: varchar(255)
	$column_Priv		= "priv"; ///колонка привязки по железу: int(1) 0-нет,1-да
	
	///Расширения файлов, к которым чувствительно обновление///
	$form				= array('jar','zip','ass','dll','dat','mod','mp3','yml','txt','.so','pkg','lib');
	
	///Информация о классе защиты///
	$class 				= "ddgdfgggfg.class";///относительный путь до класса защиты
	$classname 			= "net.k773.a";
	$method 			= "k";
	
	///Антибрут///
	$debmode			= array("K773");
	$ac 				= 3;///кол-во аккаунтов на одно железо
	$stime 				= 10;///время жизни сессии в секундах
	$cache				= 100;///время обновления мониторинга
	$bancheck			= false;///включена ли проверка на бан
	$brute_check 		= true;////включена ли проверка на брут
	$brute_table 		= "brute";
	$ip 				= $_SERVER["REMOTE_ADDR"];///вычисляем ip
	$brute_time 		= 15;////время в секундах, на сколько будет блокироваться доступ
	
	$cnews 				= false;
	$cplayers			= true;
	
	include("lib/class.simpleDB.php");
	include("lib/class.simpleMysqli.php");
	$db=new simpleMysqli($mysql);
?>
