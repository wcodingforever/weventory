-- MySQL dump 10.16  Distrib 10.1.28-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: weventory
-- ------------------------------------------------------
-- Server version	10.1.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(25) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `b_day` date NOT NULL,
  `pic` varchar(200) DEFAULT NULL,
  `bio` varchar(400) DEFAULT NULL,
  `interests` varchar(200) DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','ajetson@mailinator.com','Astro','Jetson','1901-01-01','','I like dogs.',NULL,'2018-07-30 15:39:12');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` varchar(11) NOT NULL,
  `views` int(11) NOT NULL,
  `content` varchar(100) DEFAULT NULL,
  `sticky` int(11) NOT NULL,
  `parent_comment_id` int(32) NOT NULL,
  `submit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `datefrom` datetime NOT NULL,
  `dateto` datetime DEFAULT NULL,
  `category` varchar(32) NOT NULL,
  `description` varchar(20) NOT NULL,
  `country` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `address` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `privacy` int(1) NOT NULL,
  `group_host_id` int(11) NOT NULL,
  `user_host_id` int(11) NOT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,'grand opening','0000-00-00 00:00:00',NULL,'tech','','','','',0,0,0,0,NULL,10000,'2018-07-30 17:06:54'),(2,'grand opening','0000-00-00 00:00:00',NULL,'tech','','','','',0,0,0,0,NULL,10000,'2018-07-30 17:07:20'),(3,'second opening!','2018-08-01 00:00:00','2018-08-02 00:00:00','family','','','','',0,0,0,0,NULL,-1029,'2018-07-30 17:12:18'),(4,'second opening!','2018-08-01 00:00:00','2018-08-02 00:00:00','family','','','','',0,0,0,0,NULL,-1029,'2018-07-30 17:12:31'),(5,'second opening!','2018-08-01 00:00:00','2018-08-02 00:00:00','family','','','','',0,0,0,0,NULL,1029,'2018-07-30 17:12:42'),(6,'second opening!','2018-08-01 00:00:00','2018-08-02 00:00:00','family','','','','',0,0,0,0,NULL,1029,'2018-07-30 17:13:01'),(7,'second opening!','2018-08-01 00:00:00','2018-08-02 00:00:00','family','','','','',0,0,0,0,NULL,1029,'2018-07-30 17:13:55'),(8,'Third Opening','2018-08-01 00:00:00','2018-08-02 00:00:00','Outdoors and Adventure','Third time is the ch','','','',0,0,0,0,NULL,12334545,'2018-07-30 17:27:09'),(9,'Third Opening','2018-08-01 00:00:00','2018-08-02 00:00:00','Outdoors and Adventure','Third time is the ch','','','',0,0,0,0,NULL,12334545,'2018-07-30 17:29:25'),(10,'Third Opening','2018-08-01 00:00:00','2018-08-02 00:00:00','Outdoors and Adventure','Third time is the ch','','','',0,0,0,0,NULL,12334545,'2018-07-30 17:31:35'),(11,'third opening','2018-08-01 00:00:00','2018-08-02 00:00:00','outdoors and adventure','third time is the ch','','','',0,0,0,0,NULL,12334545,'2018-07-30 17:38:28'),(12,'fourth opening','2018-08-04 00:00:00','2018-07-04 00:00:00','fashion and beauty','four.','','','',0,0,0,0,NULL,10000,'2018-07-30 17:39:21'),(13,'the final countdown','2018-12-31 00:00:00','2018-12-31 00:00:00','health and wellness','we\'re finished! (may','','','',0,0,0,0,NULL,0,'2018-08-03 13:21:54');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_participants`
--

DROP TABLE IF EXISTS `event_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `role` varchar(32) NOT NULL,
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_participants`
--

LOCK TABLES `event_participants` WRITE;
/*!40000 ALTER TABLE `event_participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_tags`
--

DROP TABLE IF EXISTS `event_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_tags` (
  `event_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_tags`
--

LOCK TABLES `event_tags` WRITE;
/*!40000 ALTER TABLE `event_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `lowered_name` varchar(64) NOT NULL,
  `category` varchar(64) NOT NULL,
  `description` varchar(400) NOT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `group_country` varchar(64) DEFAULT NULL,
  `group_city` varchar(64) DEFAULT NULL,
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_participants`
--

DROP TABLE IF EXISTS `group_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `role` varchar(32) NOT NULL,
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_participants`
--

LOCK TABLES `group_participants` WRITE;
/*!40000 ALTER TABLE `group_participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_tags`
--

DROP TABLE IF EXISTS `group_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_tags` (
  `group_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_tags`
--

LOCK TABLES `group_tags` WRITE;
/*!40000 ALTER TABLE `group_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `help_articles`
--

DROP TABLE IF EXISTS `help_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `help_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` varchar(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(100) NOT NULL,
  `content` varchar(1500) NOT NULL,
  `kind` varchar(25) NOT NULL,
  `sticky` tinyint(1) NOT NULL,
  `parent_article_id` int(11) DEFAULT NULL,
  `password` varchar(4) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `tags` varchar(250) DEFAULT NULL,
  `files` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `help_articles`
--

LOCK TABLES `help_articles` WRITE;
/*!40000 ALTER TABLE `help_articles` DISABLE KEYS */;
INSERT INTO `help_articles` VALUES (23,'user_3','2018-07-29 16:53:53','Remove or ban a member','Note: Itâ€™s currently only possible to remove or ban a member from the Desktop Web version of Meetup. \n\nOrganizers, co-organizers, and assistant organizers can choose to remove or ban members from their groups. Removing and banning serve different purposes, and it\'s up to the Meetup group leadership to choose which one is appropriate. \n\nIf you remove a member from your Meetup group, they can still request to rejoin.\nIf you ban a member, they\'re removed from your group, and can never rejoin. \n\nWhether a member is removed or banned, theyâ€™ll receive the same short message that informs them theyâ€™ve been removed from the Meetup group. Once a member has been removed, they cannot be reinstated. Theyâ€™ll only be able to rejoin your Meetup group if they take that action on their end.\n\nWhen or why to remove someone from your Meetup group is a tricky question, and it varies from member-to-member. If you\'re just removing no-shows, pending members, etc., removing them instead banning them from the group completely might be a better option for you.\n\nRemove a member\n- Click the member from the Members page of your Meetup group\n- Click the Admin Tools dropdown to the right of their name\n- Click Remove member\n- Add a message to them of your choice â€” this will be sent along with an automatic notification that they were removed\n\nBan a member\n- Click the member from the Members page of your Meetup group\n- Click the Admin Tools dropdown to the right of their name\n- Click Remove member\n- C','policies',0,NULL,'1234',0,'[\"ban\",\"remove a member\"]',NULL),(24,'user_3','2018-07-29 17:36:15','Weventory Group Content Visibility Settings','Meetup groups have two Content Visibility settings: Public and Private. These settings determine how much of a groupâ€™s content and membership information is visible to non-members and search engines. For more information about Meetup content and search engines, please see here. \n\nInformation that is always visible, no matter the Content Visibility setting:\n\nMeetup group title and description\n\nMeetup event titles, dates, times, and the number of members attending\n\nUsername and photo of the organizer\n\nNumber of members in the Meetup group\n\nTopics associated with the Meetup group\n\nMeetup group reviews\n\nNames of the group organizersâ€”including co-organizers and assistant organizers on the Leadership Team\nFor Private groups, the following information is hidden from non-members and search engines:\n\nThe usernames and profile information of the groupâ€™s members, including answers to profile questions requested by the organizer\n\nThe location for past and upcoming Meetups \n\nThe event descriptions for past and present Meetups\nThe Meetup groupâ€™s photo albums\n\nThe Meetup groupâ€™s Discussions section\n\nMaking a group private is a permanent change. Once a group is changed to private, it cannot be made public again.\n\nWhen an organizer changes the Content Visibility settings of their Meetup group, Meetup group members will be alerted via email notification.\n\nIf a member does not feel comfortable sharing the information that is visible for public groups, they have the option to leave the','policies',0,NULL,NULL,0,'[\"content\",\"visibility\"]',NULL),(25,'user_3','2018-07-30 00:58:48','Android issues','â€œHave you tried turning it off and back on again?â€ Seriously, though - uninstalling and reinstalling the Meetup app will often resolve common issues. This also ensures you have the latest, greatest, clean version of the Meetup app. Instructions to uninstall and reinstall are listed here.\n\nAndroid users:\n\nOpen your deviceâ€™s Settings app\n-Apps & notifications\n-the Meetup app. If you donâ€™t see it, try selecting See all apps or App info\nTap Uninstall\nRestart your device\nOpen the Google Play Store app\n-Menu > My apps & games > Library\n-the Meetup app\n-Install or Enable','technical_issues',0,NULL,NULL,0,'[\"android\"]',NULL),(26,'user_3','2018-07-30 01:16:07','How do I hide my interests?','Choosing interests allows us to recommend Meetup groups that we think will interest you. Your interests are displayed on your profile by default but you can keep them private if youâ€™d prefer.\n \nDesktop Web\n\nHead to your General Account Settings page.\nFrom the options on the left, select Privacy.\nUn-check the box next to \"Show interests on profile.\"\nClick Save.\nMobile Web\n\nTap on your circular Profile icon.\nTap on Settings.\nTap on Privacy.\nUn-check the box next to \"Show interests on profile.\"\nClick Save.\nAndroid App\n\nFrom the Home tab, tap your circular Profile icon in the upper right-hand corner.\nTap Edit profile.\nEdit the slider labeled \"Show interests on profile.\"\nTap the Checkmark icon to save your preferences.\niOS App\n\nFrom the Home tab, tap your circular Profile icon in the upper right-hand corner.\nTap on the Pencil icon.\nEdit the slider labeled \"Show interests on profile.\"\nTap Save to update your preferences.','account',0,NULL,'1234',0,'[\"interests\",\"privacy\",\"account\"]',NULL),(27,'user_3','2018-07-30 01:17:11','How do I request a refund from an organizer?','Note: The Payment Resolution Center is currently not accessible from the Android and iOS apps.\n\nIf youâ€™ve paid for Meetup member dues, tickets, or contributions, you can request a refund from the organizer of your Meetup. Refunds are issued at the discretion of the organizer who collected the funds, so be sure to reach out to them with questions.\n\nTo request a refund from the group organizer:\n\nDesktop Web\n\n- Click on your Profile icon in the upper right-hand corner\n- Select Settings from the drop-down menu\n- Open the Payments Made tab\n- Locate the transaction in question and select Contact organizer for refund\n- Enter the necessary information following the prompts \n\nMobile Web\n\n- Click on your Profile icon in the upper right-hand corner\n- Select Settings and choose All Transactions\n- Locate the transaction in question and tap the Arrow icon next to it\n- Tap Contact organizer for refund\n- Enter the necessary information following the prompts \nOur Payment Resolution Center can be used in the event that a dispute arises in a Meetup. This feature is available to help facilitate a conversation if a dispute arises about any type of payment made on our platform, including cash payments. We hope that creating a space for members and organizers to communicate about these issues can help resolve them more quickly. \n\nMeetup can only issue a refund in certain situations, and only if a member has used our preferred payment processor, WePay, to make the payment in question. Disputes reg','payment',0,NULL,NULL,0,'[\"refund\",\"organizer\"]',NULL),(28,'user_3','2018-07-30 01:18:32','What are contributions','Note: Contributions are currently only available for Meetups in the United States.\n\nOrganizers and leadership teams donâ€™t have to shoulder the costs of Meetups by themselves. Contributions are optional, one-time payments members can choose to make as a way to support the Meetups they love.\n\nAllowing contributions for your Meetup is completely optional. Whether or not you provide the option, free Meetups will remain free to members, and Meetup groups collecting member dues will still collect dues.\n\nContributions are automatically enabled for all new Meetup groups, but organizers can disable or re-enable them at any time.\n\nReady to start collecting contributions for your Meetup group? This Help Center article has all the information youâ€™ll need.\n\nTo collect contributions, organizers will need to set up a WePay account. Please note that all contributions are subject to a small transaction fee; WePay collects 2.8% + $0.30 as a service fee to process the payment, and Meetup collects 4.7% + $0.20.','payment',0,NULL,NULL,0,'[\"wepay\",\"contributions\"]',NULL),(29,'user_3','2018-07-30 01:20:16','Updated calendar page','We\'re rolling out an updated calendar page that makes the Meetup website feel more uniform. You\'ll be seeing more updates like this that preserve or improve functionality and also make the design consistent.\n\nWeâ€™ve heard that the calendar was hard to find, and that it was confusing to switch between design schemes on the site. Now, the calendar is easier to access on the Meetups page and has an updated look that\'s consistent with other pages on the site. Plus itâ€™s mobile responsive so it will look great on any screen you\'re browsing.\n\nNote: As we roll out the new calendar design to everyone, some members will continue to see the old experience.','organizing_events',0,NULL,NULL,0,'[\"calendar\"]',NULL),(30,'user_3','2018-07-30 01:25:29','Updated Weventory app for iPhone','Weâ€™re excited to announce the latest version of the Meetup app for iPhone. Weâ€™ve rearranged the app to make it easier to keep track of your groups and stay in touch. Now you can:\n\nEasily access your Meetup groups from your Home tab\nKeep track of your upcoming and saved events with your calendar view\nDiscover and search for your next Meetup from the Explore tab\nQuickly access your Notifications and Messages from your Meetup groups\nIn the coming months, weâ€™ll continue to work on adding functionality to help you connect with your groups on the go.\n\nUpdate your Meetup app by downloading from the App Store and please feel free to leave us a review!','organizing_events',0,NULL,NULL,0,'[\"update\",\"version upgrade\"]',NULL),(33,'admin','2018-07-30 01:30:36','Who pays for a group??','The primary organizer of a Meetup group pays for their own organizer subscription. Every Meetup group must be led by a local organizer with an active subscription plan; groups without an active organizer will close after 14 days without a named organizer.\n\nIf you have an active organizer subscription but are not the primary organizer of a Meetup group, your subscription is not supporting any Meetup groups. You could use your subscription to start and organize your own Meetup, or if you want, you could simply cancel your subscription.\n\nIf youâ€™re interested in becoming an organizer, check out the current pricing options in your area. Many organizers can also collect contributions, member dues and/or event fees from group members to help cover their costs.','payment',1,NULL,NULL,0,'[\"payment\",\"organizer\"]',NULL),(34,'admin','2018-07-30 01:32:10','How do I update my credit card information?','Update your credit card information\nYour organizer subscription plan automatically renews. When your subscription renews, we attempt to charge the most recent payment card saved for your subscription, so itâ€™s important that you make sure the card on file is active and your billing information is up-to-date.\n\nTo update your credit card information:\n\nDesktop & Mobile Web\n\nFrom your Organizer Subscription page, click Update credit card\nOn the following page, enter your new payment information\nClick Submit\nAndroid App\n\nTap your circular Profile icon from the \"Home\" tab\nTap ... Three dot icon and select Account settings\nScroll down and tap your organizer subscription\nTap Update credit card\nEnter your payment information and tap Save\niOS App\n\nIf you started your subscription via the iOS Meetup app, you can manage your subscription via the App Store on your device.','payment',0,NULL,NULL,0,'[\"credit card\"]',NULL),(35,'admin','2018-07-30 01:33:38','What browsers does Weventory support?','Right now, Meetup supports the following browsers on the full site:\n\nChrome -- The newest version here.\nFirefox -- The newest version here.\nSafari -- The newest version here.\nMicrosoft Edge -- The newest version here.\nWhile using the mobile site, the following mobile browsers are currently supported:\n\nWebKit based browers -- Default browser on iOS (iPhone, iPad, iPod) and Android phones\nFireFox Mobile for Android and iOS (iPhone, iPad, iPod)\nOpera Mobile for Android and iOS (iPhone, iPad, iPod)\nIf you\'re using a new beta version of one of the browsers above, the Meetup site will probably work, but you may run into snags. We make sure our site is compatible with official browser releases, but beta testers using newer, not-yet-official editions might have a little trouble every now and again.\n\nIf you\'re using an older version of any of the browsers listed above, your best bet would be to update it or try a different browser. \n\nIf you\'re surfing the full site on a mobile device, certain mobile browsers might cause the full Meetup site to function incorrectly. ','technical_issues',1,NULL,NULL,0,'[\"browser\",\"chrome\",\"firefox\",\"safari\",\"microsoft edge\"]',NULL),(36,'admin','2018-07-30 01:35:07','Instantly book WeWork space for your group','We want to help you focus on building community, not on logistics. So weâ€™re making it easier to find and book a great space for your Meetup. Eligible organizers can now reserve small and medium sized WeWork spaces online in under a minute.\n\nAnd itâ€™s free for a limited time. (Yes, really!)\n\nHereâ€™s how it works:\n1. Go to your Meetup group page on the web. (Coming soon to iOS and Android apps.)\n\n2. Choose \"Book a space\" in the dropdown that appears when you click \"Plan a Meetup.\"','organizing_events',0,NULL,NULL,0,'[\"wework\"]',NULL),(38,'user1','2018-07-31 18:08:51','How do I delete photos from an album?','Note: On the Android and iOS apps, itâ€™s only possible to delete photos that have been uploaded to Meetup photo albums.\n\nNot all pictures turn out great. Maybe you were having a not-so-photogenic day, or you just want to change things up with your Meetup group and start fresh. Whatever the reason, you have the ability to delete any photo you upload to a Meetup group photo album. Donâ€™t worry about another member deleting your memories; only the organizers and co-organizers can delete photos that arenâ€™t their own.\n\nPhotos deleted from an album are removed permanently. The only way to retrieve them is for the owner of the photo to re-upload them.\n\nTo delete a photo from an album:\n\nDesktop Web\n\nFrom your Meetup groupâ€™s homepage, select Photos\nOpen the album that contains the photo you want to delete\nClick the photo youâ€™d like to delete\nAbove the photo, click Delete\nConfirm by clicking Yes, Iâ€™m Sure\nMobile Web\n\nFrom your Meetup groupâ€™s homepage, select Photos\nOpen the album that contains the photo you want to delete\nFrom the thumbnails, choose the photo you want to delete\nSelect the three dots icon and choose Delete\nConfirm Delete this photo? with the Delete button\nAndroid App\n\nFrom your Meetup groupâ€™s homepage, scroll down to Group Calendar\nTap See all\nTap on the Meetup album that contains the photo you want to delete\nTap on the photo\nTap on the three dots icon in the upper right-hand corner\nSelect Delete from the drop-down menu\nIn the pop-up message that appears, ','technical_issues',0,NULL,NULL,0,'[\"profie photo\"]',NULL),(39,'user2','2018-07-30 01:40:39',' How do I link my group\'s homepage to social media?','We wanted to make it simple to engage with new friends through your other social media platforms. You have the option link your Meetup group to your Facebook, Twitter, LinkedIn, Flickr, and Tumblr accounts. This will also make it easier to show everyone else in your life how much fun youâ€™re having in your Meetup group.  \n\nFrom your Meetup groupâ€™s homepage, select Manage Group\nSelect Edit group settings \nSelect the Optional features section and scroll down to Follow us onâ€¦\nCheck the corresponding box for each social network youâ€™d like to add, and enter your social profile URLs into the spaces provided\nClick Submit to save your changes\nOnce youâ€™ve linked an account, youâ€™ll see the icon for that social media profile appear in the bottom of your Meetup groupâ€™s homepage where it says \'Find us also at.â€™','policies',0,NULL,'1234',0,'[\"social media\",\"linkedin\",\"twitter\"]',NULL),(40,'user2','2018-07-30 01:42:29','How do I download/print my Meetup attendee list?','Once you\'ve scheduled your Meetup and people have RSVP\'d, you can download a spreadsheet of your attendees. And if you\'re old school, you can print this list for reference on the day of the Meetup event itself. \n\nTo download a list of your attendees: \n\nDesktop & Mobile Web \n\nGo to the Meetup event page\nSelect Organizer tools and choose Manage RSVPs\nSelect tools again and choose Download attendees\nThis will download your RSVP list to a spreadsheet document, where you can sort and print their names.','organizing_events',0,NULL,NULL,0,'[\"print\",\"download\",\"member list\",\"attendee\"]',NULL),(41,'user4','2018-07-30 01:43:53','How do I archive messages?','Note: It is not currently possible to delete a message.\n\nAn organized inbox is a happy inbox. As you become more active on Meetup, youâ€™ll find yourself receiving more messages, and archiving old or finished messages can really help keep your inbox clean.\n\nArchiving a message moves it out of your inbox and into a separate folder. You can access archived messages in the Archive tab.\n\nIf you resume a conversation that was previously archived, weâ€™ll automatically move it back into your inbox so you donâ€™t miss any replies. You can also manually unarchive a message at any time.\n\nTo archive a message:\n\nDesktop & Mobile Web\n\nFrom your Messages page, select the message you want to archive.\nClick on the three dots icon in the upper right-hand corner of the message.\nSelect Archive from the menu.\nAndroid App\n\nTap the Messages icon.\nTap on the message you want to archive.\nTap the three dots icon in the upper right-hand corner.\nTap Archive conversation.\nTo unarchive a message:\n\nTap the Archived messages icon in the upper right-hand corner.\nSelect the message.\nTap the ... three dots icon in the upper right-hand corner.\nTap Unarchive conversation.\niOS App\n\nTap the Messages icon.\nTap the message you want to archive.\nTap the three dots icon in the upper right-hand corner.\nTap Archive.\nTo unarchive a message:\n\nTap the \"Archived messages\" section.\nSelect the message.\nTap the ... three dots icon in the upper right-hand corner.\nTap Unarchive.','technical_issues',0,NULL,NULL,0,'[\"message\",\"archive\"]',NULL),(42,'user4','2018-07-30 01:44:51','How do I edit my group\'s URL?','Creating a good web address can be tricky. Here are some tips to help you create a great URL for your Meetup group. \n\nIncorporate the purpose and location of your Meetup group\nPut dashes between words instead of combining them all into one word; this will help search engines find it\nKeep your web address between 6-70 characters\nOnly use letters, numbers, and dashes (no punctuation or special characters)\nDonâ€™t include topic names alone (e.g., singles, pets, politics, etc.) or only cities/states (ex: New York, London)\nDonâ€™t use a name of a Meetup group that has already been taken\nFeeling indecisive? You can change your web address at any time.\nTo change your Meetup Group\'s web address:\n\nFrom your Meetup group\'s homepage, select Manage group\nSelect Edit group settings \nClick on Basics\nScroll to the Where section and find Keep this or create a custom address.\nEnter the new web address youâ€™ve created in the field (our system will check and display whether it\'s available for use)\nOnce youâ€™ve chosen an available address, click Submit to save the changes','account',0,NULL,NULL,0,'[\"url\"]',NULL),(43,'user4','2018-07-30 01:46:28','Report spam or inappropriate content?','If another Meetup member posts or sends inappropriate content or spam, we encourage you to submit a report. Reports help us to keep the platform safe and enjoyable for all users.\n\nSpam messages are commercial in nature, website advertisements, and unsolicited. Inappropriate content can be anything from a derogatory comment to an offensive photo.\n\nSpam is different from an inappropriate, derogatory, or mean message. If you are reporting a message of this nature, please enter some information about the situation under Is there anything else youâ€™d like to tell Meetup?\n\nAn accurate report of the situation helps us respond quickly and effectively. Please do not select the spam option if you are not reporting a message that is commercial in nature, an advertisement, or unsolicited.\n\nâ€‹Meetup HQ\'s Integrity team reviews all reports and takes appropriate action based on our Policies and Community Guidelines. \n\n\nReport specific content (i.e. event comments, message board posts)\n\nDesktop & Mobile Web\n- Click Report or X next to the content\n\nAndroid & iOS App\n- Tap the â€¦ icon next to the content\n- Select Report from the pop up menu\n\n\nReport a message\n\n- Open the message youâ€™d like to report\n- Click the â€¦ icon in\n- Select Report from the pop up menu\n\nIf the message that you are reporting is spam, then select the box next to This person is posting spam.\n\n\nIf there is no specific content or message to report, you can report a member account from their profile page.\n \nReport a memb','policies',0,NULL,NULL,0,'[\"spam\",\"content\",\"sensor\",\"report\"]',NULL),(45,'user9','2018-07-30 01:48:41','Cookie policy','As described in our Privacy Policy, we and our service providers use cookies and other technologies to provide our Platform and to enhance your experience. This Cookie Policy sets out some further detail on how and why we use these technologies on our Platform, which includes any website, application, or service we offer. The terms \"Meetup,\" \"we,\" \"us,\" and \"our\" include Meetup Inc. and our affiliates. By using our Platform, you consent to storage and access to cookies and other technologies on your device, in accordance with this Cookie Policy.\n\nCookies\nWhat Cookies Are. Cookies are small data files which are downloaded to your device when you visit a website. Cookies are then sent back to the originating website on each subsequent visit, or to another website that recognizes that cookie. Cookies are useful because they allow us to recognize your device.\n\nHow We Use Cookies. Cookies serve a variety of functions, like enabling us to remember certain information you provide to us as you navigate between pages on the Platform. We use cookies for the following purposes:\n\nAuthentication: We use cookies to recognize you if you are logged in to our Platform. This lets us personalize your experience on or with the Platform in the ways described below. In addition, we may employ third-party services that may use cookies to help you sign into their services from our Platform.\n\n','policies',0,NULL,NULL,0,'[\"cookie\"]',NULL),(46,'admin','2018-07-30 01:50:24','Member Restrictions','Meetup Member Restrictions\nMeetup takes member account privacy very seriously and has strict rules regarding who can access or create a Meetup account. Please know we reserve the right to suspend or remove any account, or limit access to certain features of the platform, for any reason, at our sole discretion.\n\nDeceased Member Policy\nIf a member or organizer passes away, Meetup cannot provide access to their account, even to family members or people acting on the behalf of the estate. Meetup will work with families and honor their wishes if they choose to close accounts or Meetup groups, or transfer them to another member.\n\nUnder 18 Participation\nMeetup members and organizers must be at least 18 years of age. Therefore, Meetup groups must be targeted at, and only offer opportunities for those who are over 18. \n\nWhile Meetups are welcome to provide activities for families, any children present at a Meetup must be supervised and accompanied by an adult guardian.\n\n \n\nCriminal Record\nMeetup may remove certain members when we become aware that the member is a convicted sex offender or has been convicted of a violent, fraudulent, or dangerous crime. Meetup may also remove a member based on their criminal record, for safety, or for other concerns. Members with concerns about criminal or illegal activity should always report it to local authorities.\n\n','organizing_events',1,NULL,NULL,0,'[\"member\",\"restriction\"]',NULL),(47,'admin','2018-07-30 01:52:09','Best Organizer Practices','Respect the Original Intent: Don\'t Tamper with Meetups\nConverting a Meetup group, changing Meetup events, or adding Meetup events, so they no longer align with the expectations and purpose set by the organizer and leadership team, is prohibited on the grounds that it is misleading. \n\nThe intentions of the Meetup group should remain generally consistent with member expectations. While Meetups often evolve and change over time, changes should be agreed upon by group membership and well-communicated, so people can make informed decisions about their continued participation.\n\nConverting\nIt is prohibited to step up as organizer to a Meetup in order to change the focus of the Meetup, to close the Meetup, to send or post promotional content, or to send or post content not aligned with the original description of the Meetup. If it is your intention to change the meaning or purpose of a Meetup, we advise that you start a new Meetup instead. If a Meetup group gets a new organizer, the mission of that Meetup group should stay the same. Events in a Meetup group should reflect intentions expressed in the Meetup group description.\n\nTampering\nIt is prohibited to alter the content or settings of a Meetup group without permission from the main organizer, or in a way that is not aligned with the purpose of that Meetup group. Any use of Meetup tools or features to disrupt the Meetup or destroy content for the purpose of undermining or undercutting the established community is a violation of our','others',0,NULL,NULL,0,'[\"best organizer\"]',NULL),(48,'user8','2018-07-30 01:55:35','Contacting other members','Connecting with the other members of your Meetup group is a great way stay informed and get involved (not to mention make new friends.) There are a few different ways to get in touch with your fellow Meetup members, depending on who youâ€™re trying to contact.\n\nFor a member to contact an organizer:\n\nVia Desktop & Mobile Web\n\nGo to your Meetup group/s page\nScroll down to the Members section\nSelect Message next to the organizerâ€™s name\n\nOn Android & iOS Apps\n\nGo to your Meetup groupâ€™s homepage\nScroll down until you see Organized byâ€¦\nTap Contact\nFor an organizer to contact a member:\n\nVia Desktop & Mobile Web\n\nFrom your Meetup groupâ€™s homepage, select More\nChoose Contact members\nCompose your message and Submit\nOn Android & iOS Apps\n\nGo to your Meetup groupâ€™s page\nTap the three dots icon in the upper right hand corner\nSelect Contact members from the pop-up menu\nCompose your message and Send\nFor a member to contact another member:\n\nGo to the profile of the member youâ€™d like to contact\nClick the message icon next to the memberâ€™s name\nCompose your message and Send\n','organizing_events',0,NULL,NULL,0,'[\"contact\",\"message\"]',NULL),(49,'user8','2018-07-30 01:56:55','Who runs a Weventory group?','Meetup groups are powered by their organizers, the movers and the shakers who make Meetups happen.\n\nTo get started, organizers need an organizer subscription plan. From there itâ€™s up to them how they run things. They decide what itâ€™s all about and share important news for the wider group.\n\nWhile organizers are the force that keep Meetup groups alive, they do not have to do it alone. Some of our most successful organizers build a leadership team to strengthen their efforts and cultivate their community.\n\n','others',0,NULL,NULL,0,'[\"weventory\"]',NULL),(50,'user12','2018-07-30 01:58:38','How do I share my location?','More socially acceptable than a megaphone in a public space, and probably more effective: make your Meetup easy to find by sharing your location privately with other members when you arrive.\n\nTo do this, start at your Meetup Messages on the Android or iOS app:\n\nAndroid App\n\nTap the Messages tab.\nStart a new message by tapping the + icon.\nEnter the names of the members you want to receive your location.\nTap the pin icon to the left of the text box.\nTap Share location to send your location.\niOS App\n\nTap the Messages tab.\nStart a new message by tapping the + icon.\nEnter the names of the members you want to receive your location then tap Done.\nTap the pin icon to the left of the text box.\nTap Share to send your location.\nWhen you share your location, recipients will see the following:','account',0,NULL,'1234',0,'[\"location\"]',NULL),(51,'user12','2018-07-30 02:00:01','How do I change my account name?','Note: Itâ€™s currently only possible to change your account name via your desktop web browser and the mobile Meetup apps.\n\nYou can use just one account name in Meetup, which means you canâ€™t set different names for each of your Meetup groups. Your account name will be publicly visible on Meetup and also in search engine results.\n\nTo change your account name:\n\nDesktop Web\n\nClick on your profile icon.\nSelect Settings from the drop-down menu.\nClick edit next to your current name.\nEnter your preferred name.\nClick Submit.\nAndroid app\n\nFrom the Home tab, tap your circular Profile icon in the upper right-hand corner.\nTap Edit profile.\nTap on your current name to edit.\nTap the Checkmark icon to confirm.\niOS app\n\nFrom the Home tab, tap your circular Profile icon in the upper right-hand corner.\nTap on the pencil icon.\nTap on your current name to edit.\nTap Save to confirm.','account',0,NULL,NULL,0,'[\"account name\"]',NULL),(52,'user12','2018-07-30 02:01:26','Pro Weventory','To access the page, log into your Meetup Pro account here: www.meetup.com/pro\n\n1. \'Members\'\n\nThis is your Meetup Pro communication tool.\n\nYou can send targeted messages to members of your community based on membership status, behavior, or activity level.\n\nTo use the tool, tap the â€˜membersâ€™ tab in the top navigation bar. Search for members using the following filters:\n\n- Name\n- Location\n- Radius\n- Number of Meetups attended\n- Meetup Group\n- Join date\n- Last active\n- Organizer status\n\nFilters can be combined to find more specific cross-segments like â€˜Members in New York who have attended more than 3 Meetupsâ€™.\n\nTo select an individual (or a group of individuals) from a filtered list, check and uncheck the boxes beside the memberâ€™s name.\n\nTo send a message, tap â€˜contact [x] membersâ€™ in the top left corner. Fill out your message and tap â€˜sendâ€™.\n\nMeetup will notify members of your message by email, and members will be able to reply directly to the email address on file for your Meetup account. [Note to Coralie: Please confirm]\n\nTo view your communication history, tap the â€˜Sent Messagesâ€™ link at the top of the page. The following page will display the date, subject, and content of the messages youâ€™ve sent using this tool. You can view the recipients list, and re-send a message to that list, by tapping â€˜To: [x] membersâ€™ right above the subject line of a particular message.\n\n2. \'Groups\'\n\nThis is your Meetup Pro data tool.\n\nTo access data about your communit','others',0,NULL,NULL,0,'[\"pro weventory\"]',NULL);
/*!40000 ALTER TABLE `help_articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` varchar(400) NOT NULL,
  `send_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `content` varchar(400) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_login` varchar(25) NOT NULL,
  `password` varchar(64) NOT NULL,
  `session_id` varchar(64) NOT NULL,
  `expir_date` datetime NOT NULL,
  `user_country` varchar(64) NOT NULL,
  `user_city` varchar(64) DEFAULT NULL,
  `user_lat` decimal(10,8) DEFAULT NULL,
  `user_lon` decimal(11,8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES (1,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','1595547782f1eb86943e1ed89abdb79ae66e956b5d34351c0527564f88d29520','2018-07-30 15:42:19','USA',NULL,NULL,NULL),(2,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','e1a0ff4b88143860df1e5ebfd12821541b5fc280f86fedb0cf8abcc9d41c824f','2018-07-30 15:42:30','USA',NULL,NULL,NULL),(3,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','2dacf3904536fc3b2897e628506fbcdbb8c50f3c903f2327b4be7e4acd9d7e0e','2018-07-30 15:52:54','USA',NULL,NULL,NULL),(4,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','c5fd3323301f101613e0049b34ac658169966c15665317fc4ca7599155d7fd3a','2018-07-30 16:21:31','USA',NULL,NULL,NULL),(5,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','9e0a0054e0620374b2ee4b0110861ed85ce5359eab099b80830aa2e69fe633cb','2018-07-30 16:22:23','USA',NULL,NULL,NULL),(6,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','7fe56f93894282d6e6e4ebe0da1daab4128ec4164323433ad26ca65852afb17d','2018-07-30 17:02:55','USA',NULL,NULL,NULL),(7,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','fe9d1be053b8b3093cbfa274e5e316bf6202b839214de7a3d115cb885cce9fe8','2018-07-30 17:03:06','USA',NULL,NULL,NULL),(8,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','05a1e0b36734930ef39ccb10aecde7f8855c689e00a214f910a17ad139cdbf4f','2018-07-30 17:04:41','USA',NULL,NULL,NULL),(9,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','b4d5bbedc9aca82cb476321a44da438839b1016280651fe0f6afdf417adcffeb','2018-07-30 17:13:36','USA',NULL,NULL,NULL),(10,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','903fad0929dd9da225ebefb87179a791a4d3db856a90ec05253eb15c626dc1f5','2018-07-30 17:23:11','USA',NULL,NULL,NULL),(11,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','ae4131116eed54683b8f7252c2874497762feeb4bfce6902f62fe8e9daf2963e','2018-07-30 17:43:10','USA',NULL,NULL,NULL),(12,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','7282e0be02ef4ed56af2f283824ba5ce34581bfc617e533266391ec55846606c','2018-07-30 17:50:29','USA',NULL,NULL,NULL),(13,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','b7fc1629b989d48c8efab2c2595e50b22dad7ee316b71c5fb755fc39d5e1bfa9','2018-07-30 18:12:36','USA',NULL,NULL,NULL),(14,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','4932de96a310d53bbe74aea6690f1c3cd9b27e27e4dd279c33ca1e7ed244bd6b','2018-07-30 18:14:44','USA',NULL,NULL,NULL),(15,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','0599fd7cfe5a4eb58b65a2c1b0b138346cdb2c612914d790071961fcca1d7e13','2018-08-03 13:23:04','USA',NULL,NULL,NULL),(16,1,'ajetson','ede7ccd858a8f6187c161b66025aa7cc9619eeb19127ca718e6cd6d01c3c8edd','ba2c494f1aa662d504d34d02d8275bd1ec20d4f932a1269fc3217f74e691ad32','2018-08-03 13:25:15','USA',NULL,NULL,NULL);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_title` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_title` (`tag_title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `verification`
--

DROP TABLE IF EXISTS `verification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `verification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(25) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `pin` int(11) NOT NULL,
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `verification`
--

LOCK TABLES `verification` WRITE;
/*!40000 ALTER TABLE `verification` DISABLE KEYS */;
INSERT INTO `verification` VALUES (1,'george','George',26486,'2018-07-31 15:23:14');
/*!40000 ALTER TABLE `verification` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-03 13:32:26
