-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 11:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daakticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_actions`
--

CREATE TABLE `admin_actions` (
  `action_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action_description` text NOT NULL,
  `action_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_actions`
--

INSERT INTO `admin_actions` (`action_id`, `user_id`, `action_description`, `action_timestamp`) VALUES
(1, 46, 'Viewed admin activity log', '2024-11-23 17:55:26'),
(2, 46, 'Viewed admin activity log', '2024-11-23 17:58:41'),
(3, 46, 'Viewed admin activity log', '2024-11-23 18:08:05'),
(4, 46, 'Viewed admin activity log', '2024-11-23 18:08:44'),
(5, 46, 'Viewed admin activity log', '2024-11-23 18:08:49'),
(6, 46, 'Viewed admin activity log', '2024-11-23 18:09:07'),
(7, 46, 'Viewed admin activity log', '2024-11-23 18:09:16'),
(8, 46, 'Viewed admin activity log', '2024-11-23 18:09:25'),
(9, 46, 'Viewed admin activity log', '2024-11-23 19:02:33'),
(10, 46, 'Viewed admin activity log', '2024-11-23 19:03:14'),
(11, 46, 'Viewed admin activity log', '2024-11-23 19:03:16'),
(12, 46, 'Viewed admin activity log', '2024-11-23 19:03:18'),
(13, 46, 'Viewed admin activity log', '2024-11-23 19:04:25'),
(14, 46, 'Viewed admin activity log', '2024-11-23 19:04:35'),
(15, 46, 'Viewed admin activity log', '2024-11-24 03:27:13'),
(16, 46, 'Viewed admin activity log', '2024-11-24 03:28:09'),
(17, 46, 'Viewed admin activity log', '2024-11-24 03:28:10'),
(18, 46, 'Viewed admin activity log', '2024-11-24 07:16:06'),
(19, 46, 'Viewed admin activity log', '2024-11-24 12:37:35'),
(20, 46, 'Viewed admin activity log', '2024-11-25 07:46:31'),
(21, 46, 'Viewed admin activity log', '2024-11-25 13:42:41'),
(22, 46, 'Viewed admin activity log', '2024-11-25 13:42:53'),
(23, 46, 'Viewed admin activity log', '2024-11-26 03:51:50'),
(24, 46, 'Viewed admin activity log', '2024-11-26 04:33:21'),
(25, 46, 'Viewed admin activity log', '2024-11-26 15:34:25');

-- --------------------------------------------------------

--
-- Table structure for table `audit_log`
--

CREATE TABLE `audit_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `feature_image` varchar(500) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `status` enum('pending','approved','rejected','draft') DEFAULT 'pending',
  `rejection_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`post_id`, `user_id`, `title`, `content`, `created_at`, `updated_at`, `feature_image`, `category_id`, `status`, `rejection_reason`) VALUES
(1, 46, 'The Power of Native Plants', 'Have you ever wondered why your garden is so challenging to maintain? Our gardens and landscapes are often filled with beautiful non-native plants but are usually difficult to maintain. These non-native plants may inadvertently be invasive, disrupting the local ecosystem and causing your garden to wither quickly.\r\n\r\nNon-native species can crowd out native plants, leading to a decline in wildlife that relies on native flora for food and shelter. This imbalance threatens biodiversity, affecting everything from pollinators to small mammals and even soil and water quality.\r\n\r\nAll of these can be avoided by choosing native plants.\r\n\r\nHere’s how you can support local wildlife and start a stress-free garden with the power of native plants.\r\nUnderstanding Native Plants and Their Role in Ecosystems\r\n\r\nNative plants have evolved to grow in a particular region over thousands of years, adapting their unique soil, climate, and wildlife. Unlike many ornamental or imported plants, native species form symbiotic relationships with local fauna, offering food, shelter, and habitat.\r\n\r\nNative plants are essential to the survival of various wildlife, including pollinators like bees and butterflies, which are critical to agricultural and natural ecosystems.\r\n\r\nHere are some benefits of native plants.\r\nEnhance Wildlife Support\r\n\r\nNative plants attract more local wildlife, including birds, insects, and small mammals, who depend on them for food and nesting materials.\r\nReduced Water Consumption\r\n\r\nBecause they’re suited to local conditions, native plants require less water, making them a sustainable choice in drought-prone areas.\r\nEasy to Maintain\r\n\r\nNative plants typically need fewer pesticides and fertilizers, as they’ve developed natural defenses against local pests and diseases, resulting in less environmental impact from chemical use.\r\nSoil Health and Erosion Control\r\n\r\nNative plants help anchor soil with a deep root system that prevents erosion and, in turn, fosters nutrient-rich soil that supports other plant life.\r\nnative plants\r\nSelecting the Right Native Plants for Your Region\r\n\r\nWhen incorporating native plants into your yard or garden, it’s crucial to choose species that align with your region’s climate, soil type, and native wildlife needs. Different plants serve varied purposes and support unique subsets of wildlife, so understanding your local ecosystem is vital to making the right choices.\r\n1.   Research Your Local Ecosystem\r\n\r\nNative plant societies, botanical gardens, and environmental organizations provide resources and plant lists specific to your region. Look for guides that specify which plant benefits certain pollinators or birds native to your area.\r\n2.   Consider Plant Types and Functions\r\n\r\nNative plants can range from flowers and grasses to shrubs and trees, each with unique roles in supporting wildlife. For example, milkweed is essential for monarch butterflies, while berry-producing shrubs like elderberry support birds and mammals.\r\n3.   Choose a Range of Bloom Times\r\n\r\nFor a garden that supports wildlife year-round, select plants that bloom at different times of the year. This approach ensures a continuous food source for pollinators and other wildlife, even in cooler months.\r\nHow Native Plants Support Local Wildlife\r\n\r\nNative plants form the backbone of any healthy ecosystem. Their foliage, flowers, fruits, and seeds provide the proper nutrition for local wildlife, supporting a complex food web that includes insects, birds, mammals, and reptiles.\r\nPollinators\r\n\r\nPollinators such as bees, butterflies, and hummingbirds are among the most immediate beneficiaries of native plants. These species have evolved alongside native plants, forming a symbiotic relationship where plants offer nectar and pollen while pollinators help plant reproduction.\r\n\r\nMany bee species are specialists, meaning they can only gather pollen from certain plants. Butterflies, on the other hand, rely on specific plants for their life cycles.\r\nBirds and Mammals\r\n\r\nNative plants are a crucial part of many bird and mammal diets. Shrubs that produce berries, such as serviceberry or elderberry, provide a steady food source. Birds rely on native plants for shelter and nesting materials, with dense shrubs offering safe places to hide from predators.\r\nPractical Tips for Planting and Maintaining Native Gardens\r\n\r\nCreating a garden with native plants involves a few key strategies to ensure it’s sustainable, low-maintenance, and wildlife-friendly.\r\n1.   Prepare the Soil Thoughtfully\r\n\r\nNative plants are typically suited to the natural soil of their region and may not need added fertilizers or extensive soil amendments. However, if you have compacted or nutrient-poor soil, consider using landscape fabric to protect soil quality, prevent erosion, and keep out invasive weeds, which can compete with native plants for resources.\r\n\r\nWhen paired with mulch or gravel, any thick landscape fabric can effectively suppress weeds while maintaining soil health. For more tips on installation and selecting the right fabric, explore trusted resources to ensure the best results for your garden.\r\n2.   Watering Needs\r\n\r\nNative plants are generally more drought-tolerant than non-native species, but young plants may need watering in their first season to establish roots. After that, native plants often thrive on natural rainfall alone.\r\n3.   Use Companion Planting\r\n\r\nCompanion planting is the practice of pairing plants that benefit each other. For example, pairing groundcover plants with taller shrubs can create a layered landscape that offers wildlife food and shelter while preventing soil erosion and reducing the need for weeding.\r\n4.   Eliminate Invasive Species\r\n\r\nInvasive plants can outcompete native species for resources, making identifying and removing them essential. Plants like English ivy or Japanese knotweed, common in many gardens, can wreak havoc on native ecosystems. Replace these with native options to encourage a balanced, sustainable garden.\r\nTo Wrap Up\r\n\r\nNative plants offer a powerful way to reconnect with local ecosystems, support wildlife, and contribute to a more sustainable environment. Each region has its unique set of flora, creating opportunities for gardeners to cultivate beautiful and ecologically beneficial landscapes.\r\n\r\nBy understanding the symbiotic relationship between native plants and wildlife, individuals can take meaningful steps toward preserving biodiversity and creating spaces that support the natural world.', '2024-11-21 06:30:43', '2024-11-24 03:54:41', 'assets/uploads/post_images/post_1732269634_native-plants.jpg', 5, 'approved', NULL),
(2, 46, 'Why save water?', 'Why Save Water?\r\nSave Money\r\n\r\nSaving water saves money especially if you are on a water meter. Installing simple devices such as water-efficient taps and showers will save both water and energy by minimising the use of heated water. Around 18% of energy consumption in UK homes is spent heating water, and about 12% of a typical gas heated home’s heating bill is from the water for showers, baths and the hot water tap. So even if you don’t have a water meter you could still be saving money on your energy bill. Such large financial savings can be particularly vital for households facing water and energy poverty.\r\nClimate Change\r\n\r\n“With population growth, changing weather patterns including hotter summers and drier winters, water is becoming increasingly vulnerable to scarcity, even in the UK.  By 2040, we expect more than half of our summers to exceed 2003 temperatures. That will mean more water shortages: by 2050, the amount of water available could be reduced by 10-15%, with some rivers seeing 50%-80% less water during the summer months. It will mean higher drought risk, caused by the hotter drier summers and less predictable rainfall. On the present projections, many parts of our country will face significant water deficits by 2050, particularly in the south east where much of the UK population lives. ” Sir James Bevan, Jaws of Death Speech\r\n\r\n    Water is the primary medium through which we will feel the effects of climate change\r\n    UN Water\r\n\r\nOur use of water and energy are closely linked. Operational emissions from the water industry account for nearly 1% of the UK’s total carbon emissions. This is because water treatment is energy and chemical intensive and transporting water around the country requires a great deal of pumping.  Reducing your water use will therefore have an impact on your carbon footprint.\r\nThe Environment\r\n\r\nUsing water efficiently means that we can minimise the amount of additional water resources being taken out of our rivers and aquifers, especially as demands are rising. This protects our water resources and the wildlife that live in them and rely on them for their survival.\r\nSecuring Water Supplies\r\n\r\nAs water resources become more scarce building new infrastructure to meet growing demand becomes increasingly expensive. If we save water instead, we can offset the need for new infrastructure and reduce pressure on existing ones. Additionally, efficient water use makes our supply more resilient against impacts from climate change, such as droughts.', '2024-11-21 16:33:07', '2024-11-24 03:53:57', 'assets/uploads/post_images/post_1732269615_360_F_728628833_E0VLbogqfrDmwO1UIgoDmMuQJVHw9F7C.jpg', 5, 'approved', NULL),
(5, 46, 'Fashion', ' Does Fashion is everything for human life?\r\ndescription', '2024-11-21 19:03:09', '2024-11-24 03:53:55', 'assets/uploads/post_images/post_1732215789_mdl06.jpg', 9, 'approved', NULL),
(7, 43, 'Make money', 'If you want to make money, go to money market. \r\nWhat Is the Money Market?\r\nThe money market refers to trading in very short-term debt investments. It involves continuous large-volume trades between institutions and traders at the wholesale level. It includes money market mutual funds bought by individual investors and money market accounts opened at banks at the retail level.\r\n\r\nThe money market is characterized by a high degree of safety and relatively low rates of return on investment.', '2024-11-22 04:00:37', '2024-11-24 03:53:53', 'assets/uploads/post_images/post_1732248037_R.jpeg', 11, 'approved', NULL),
(8, 43, 'Does Human Brain Multifunctioning?', 'The brain is an organ that serves as the center of the nervous system in all vertebrate and most invertebrate animals. It consists of nervous tissue and is typically located in the head (cephalization), usually near organs for special senses such as vision, hearing and olfaction. \r\nThe human brain is a marvel of multitasking. It can handle multiple tasks simultaneously, thanks to its complex network of neurons and various specialized regions. For example, you can walk, talk, and chew gum at the same time because different parts of your brain are responsible for each activity. This ability to manage several tasks at once is known as cognitive flexibility.\r\n\r\nHowever, it\'s important to note that while the brain can juggle multiple tasks, it doesn\'t always do so with equal efficiency. When you try to focus on too many things at once, your performance on each task can suffer. This is why it\'s often better to concentrate on one task at a time for optimal results.', '2024-11-22 04:12:22', '2024-11-26 04:40:00', 'assets/uploads/post_images/post_1732248742_OIP.jpeg', 8, 'approved', NULL),
(9, 47, 'Exploring the World with Purpose', 'In today’s fast-paced world, travel has become more about ticking destinations off a list than truly experiencing them. The rise of social media has turned many trips into a quest for the perfect Instagram shot rather than an opportunity to connect with new cultures, people, and environments. Mindful travel is the antidote to this rush—a chance to slow down, immerse yourself, and create meaningful memories that go beyond the superficial.\r\n\r\nAt its core, mindful travel encourages us to be fully present in the moment. It’s about savoring the little details: the aroma of a local dish, the sound of unfamiliar languages, or the colors of a bustling marketplace. Instead of rushing to cover a dozen attractions in a day, mindful travelers focus on fewer activities but experience them deeply. Whether it’s spending a day learning about a community’s history or simply sitting by a quiet river, the quality of the experience takes precedence over quantity.\r\n\r\nAnother aspect of mindful travel is respecting the places and cultures you visit. This means being aware of how your actions impact the environment and local communities. Opting for eco-friendly accommodations, supporting local businesses, and learning basic phrases in the native language are small steps that make a big difference. Traveling mindfully not only enriches your journey but also ensures that future generations can enjoy these destinations.\r\n\r\nIn the end, mindful travel is a mindset shift. It’s about moving away from the pressure to do and see everything and instead embracing the joy of simply being. By traveling with intention, you’ll not only create more meaningful experiences but also return home with a deeper appreciation for the world and your place in it. nice', '2024-11-22 15:04:57', '2024-11-25 17:44:11', 'assets/uploads/post_images/post_1732522681_post_1732287897_post_1731918078_Exploring the World with Purpose.webp.webp', 37, 'approved', NULL),
(10, 47, 'Why Rest Is the New Productivity Hack', 'For years, the hustle culture glorified long hours and sleepless nights as the ultimate badge of success. But in recent times, a growing body of research has flipped the narrative, revealing a surprising truth: quality sleep is one of the most powerful productivity tools we have. As more people recognize the critical role rest plays in our mental and physical health, the “sleep revolution” is reshaping how we approach work and life.\r\n\r\nSleep isn’t just about recharging our bodies—it’s essential for cognitive function, creativity, and emotional well-being. Studies show that a good night’s rest enhances problem-solving skills, boosts memory, and reduces stress. In a world that demands constant mental agility, sacrificing sleep to “get ahead” often backfires, leading to burnout, decreased performance, and even long-term health issues.\r\n\r\nThe sleep revolution also challenges the stigma surrounding rest. Taking naps, setting boundaries for work hours, and prioritizing sleep hygiene are no longer seen as signs of laziness but as strategic moves to optimize overall well-being. From blackout curtains to white noise machines, people are investing in tools and routines to ensure they get the restorative sleep their bodies need.\r\n\r\nAs the narrative around rest continues to evolve, it’s clear that embracing sleep is not a step back—it’s a leap forward. Prioritizing rest isn’t just about feeling better; it’s about unlocking your full potential. In a world that’s always on, choosing to turn off and recharge might just be the smartest move you can make.', '2024-11-23 14:18:46', '2024-11-25 17:44:07', 'assets/uploads/post_images/post_1732522670_post_1731918181_Why Rest Is the New Productivity Hack.webp', 9, 'approved', NULL),
(11, 47, 'SpaceX Starship\'s Bold Leap', 'SpaceX’s Starship, the ambitious brainchild of Elon Musk, recently took another step towards redefining space travel, with major tests showcasing its potential for reaching Mars and beyond. As Musk pushes the boundaries of aerospace technology, Starship represents the future he envisions: a fully reusable spacecraft capable of carrying large crews and heavy cargo across vast distances in our solar system. For many, it’s a marvel of human ingenuity—a symbol of how far private space exploration has come. However, with every bold step forward, skeptics question the readiness and safety of such an ambitious project.\r\n\r\nThere’s no doubt that Starship’s success would be a monumental leap for space exploration. It could transform the logistics of space travel, making it far more accessible than ever before. Imagine a future where missions to the Moon and Mars are not one-time events but routine journeys. SpaceX has already achieved remarkable milestones with its Falcon rockets and Dragon capsules, proving that private companies can lead the charge in space exploration. Starship’s potential to carry large payloads and host multiple missions has some experts calling it a game-changer in how we approach both scientific research and the long-discussed dream of human colonization of Mars.\r\n\r\nYet, Starship’s journey has not been without setbacks, and some question whether Musk’s vision is too grand. The repeated test explosions and delays have caused skepticism about the project\'s feasibility in the short term. Critics argue that the pursuit of ambitious deadlines—sometimes driven by Musk’s relentless pace—may compromise safety and efficiency. While SpaceX is known for its willingness to \"fail fast\" in the name of innovation, the stakes are much higher with Starship. It’s one thing to test small components or unmanned missions, but sending humans to deep space brings a level of risk that demands a cautious approach.\r\n\r\nIn the end, whether Starship will prove to be the revolution Musk promises or simply a high-stakes gamble remains to be seen. But one thing is certain: Elon Musk’s drive to expand the limits of what’s possible has reignited the public’s passion for space. Starship represents more than just a rocket; it’s a conversation starter, pushing humanity to ask big questions about our future beyond Earth. For now, as we watch the highs and lows of this daring project unfold, the world waits to see if Musk’s vision will carry us to new worlds or if some dreams are best approached with a more grounded view.', '2024-11-23 14:22:49', '2024-11-25 17:44:05', 'assets/uploads/post_images/post_1732522660_post_1731909932_rocket-catcher-elon-musk.jpg', 15, 'approved', NULL),
(12, 47, 'How Athletes Build Resilience Under Pressure', 'In sports, physical talent and skills are critical, but the ability to perform under pressure is often what separates great athletes from the good ones. Whether it’s hitting a clutch shot in basketball, scoring a penalty in soccer, or serving on match point in tennis, mental resilience plays a crucial role in an athlete’s success. But how do athletes cultivate the mental toughness required to thrive in high-stakes situations?\r\n\r\nBuilding resilience starts with training the mind as much as the body. Visualization techniques, for instance, are a common practice among elite athletes. By mentally rehearsing scenarios, players can reduce anxiety and improve focus when they encounter similar situations in real life. Serena Williams, for example, has spoken about using visualization to prepare for high-pressure moments on the court. This mental preparation allows athletes to stay calm and execute their skills with precision.\r\n\r\nAnother key to resilience is the ability to learn from failure. Losses and mistakes are inevitable in sports, but how an athlete responds can define their career. The best athletes, like Michael Jordan and Tom Brady, view setbacks as opportunities to grow. They analyze their performance, adjust their strategy, and return stronger. This mindset not only helps them bounce back but also instills confidence that they can overcome future challenges.\r\n\r\nIn the end, mental resilience is about adaptability and staying grounded. Athletes who build strong support systems, practice mindfulness, and embrace challenges as part of the journey often achieve greater success. Their ability to handle pressure with poise serves as a powerful reminder that sports are not just about physical prowess but also about mastering the mental game.', '2024-11-23 18:57:15', '2024-11-26 05:39:01', 'assets/uploads/post_images/post_1732388235_How Athletes Build Resilience Under Pressure.webp', 38, 'approved', NULL),
(15, 47, '5 Personal Finance Habits to Master in 2024', 'Managing personal finances effectively is essential for building a secure future. In 2024, with economic uncertainty still lingering, smart money habits are more important than ever. Here are five strategies to keep your finances on track:\r\n\r\nEmbrace Automation: Set up automatic transfers to savings and investments. Tools like budgeting apps help you track spending effortlessly while building financial discipline.\r\n\r\nInvest in Low-Risk Assets: With market volatility, consider diversified funds or bonds to safeguard your investments.\r\n\r\nEmergency Fund First: Aim for at least three months\' worth of expenses saved in an accessible account to prepare for unexpected situations.\r\n\r\nLimit Subscriptions: Audit and cancel unused subscriptions; small cuts can lead to big savings over time.\r\n\r\nUpskill for Financial Growth: Learning new skills can increase your earning potential, especially as industries evolve.\r\n\r\nBy adopting these habits, you can build a financial cushion and work toward your long-term goals.', '2024-11-24 12:30:22', '2024-11-25 17:44:02', 'assets/uploads/post_images/post_1732451422_stock-market-exchange-economics-investment-graph.webp', 11, 'approved', NULL),
(17, 46, 'Spider-Man: Across the Spider-Verse ', 'Spider-Man: Across the Spider-Verse (2024) has become an instant favorite for many moviegoers, combining incredible animation, an intricate plot, and the emotional depth that Marvel fans love. This sequel to Into the Spider-Verse takes Miles Morales on a mind-bending adventure through different dimensions, each with its own unique animation style.\r\n\r\nThe film isn’t just about action-packed sequences—it dives into the complexities of identity, responsibility, and personal growth. With stunning visuals and a deep connection to its characters, this movie is a must-watch for both Spider-Man fans and newcomers alike. It’s a perfect mix of entertainment and heart.', '2024-11-25 06:51:15', '2024-11-25 08:18:39', 'assets/uploads/post_images/post_1732517475_spiderman_accross_the_spider_verse.webp', 4, 'approved', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(2, 'Business & Entrepreneurship'),
(3, 'Education'),
(4, 'Entertainment'),
(5, 'Environment'),
(36, 'Fitness'),
(7, 'Food & Recipes'),
(8, 'Health & Wellness'),
(9, 'Lifestyle'),
(10, 'Parenting'),
(11, 'Personal Finance'),
(12, 'Politics'),
(13, 'Science'),
(14, 'Self Improvement'),
(38, 'Sports & Fitness'),
(15, 'Technology'),
(37, 'Travel');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `post_id`, `user_id`, `comment_text`, `created_at`) VALUES
(1, 8, 47, 'unga bunga\r\n', '2024-11-22 15:02:44'),
(3, 8, 46, 'nice article', '2024-11-22 18:31:54'),
(4, 9, 46, 'Good', '2024-11-22 18:32:06'),
(5, 9, 47, 'Sundor likhecho', '2024-11-22 19:06:13'),
(6, 12, 46, 'Informative', '2024-11-23 18:59:22'),
(24, 17, 47, 'Awesome!!!', '2024-11-25 13:41:14');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likes_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likes_id`, `post_id`, `user_id`, `created_at`) VALUES
(3, 2, 47, '2024-11-22 17:57:44'),
(12, 9, 46, '2024-11-22 19:00:46'),
(14, 9, 47, '2024-11-22 19:09:47'),
(15, 10, 47, '2024-11-23 14:19:33'),
(16, 12, 46, '2024-11-23 18:59:16'),
(17, 11, 47, '2024-11-25 06:27:55'),
(18, 17, 46, '2024-11-25 08:56:10'),
(19, 17, 47, '2024-11-25 09:49:22'),
(20, 8, 47, '2024-11-25 18:14:09'),
(21, 5, 47, '2024-11-26 05:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `media_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`media_id`, `post_id`, `file_path`, `file_type`, `uploaded_at`) VALUES
(1, 10, 'assets/uploads/post_images/post_1732371526_post_1731918181_Why Rest Is the New Productivity Hack.webp', '', '2024-11-23 14:18:46'),
(2, 11, 'assets/uploads/post_images/post_1732371769_post_1731909932_rocket-catcher-elon-musk.jpg', '', '2024-11-23 14:22:49'),
(4, 12, 'assets/uploads/post_images/post_1732388235_How Athletes Build Resilience Under Pressure.webp', '', '2024-11-23 18:57:15'),
(7, 15, 'assets/uploads/post_images/post_1732451422_stock-market-exchange-economics-investment-graph.webp', '', '2024-11-24 12:30:22'),
(9, 17, 'assets/uploads/post_images/post_1732517475_spiderman_accross_the_spider_verse.webp', '', '2024-11-25 06:51:15');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `permission_name`) VALUES
(1, 'create_content'),
(3, 'delete_content'),
(2, 'edit_content'),
(4, 'manage_users');

-- --------------------------------------------------------

--
-- Table structure for table `post_history`
--

CREATE TABLE `post_history` (
  `history_id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `change_description` text DEFAULT NULL,
  `change_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_history`
--

INSERT INTO `post_history` (`history_id`, `post_id`, `user_id`, `change_description`, `change_timestamp`) VALUES
(1, 1, 46, 'Admin created a new post: The Power of Native Plants', '2024-11-21 06:30:43'),
(4, 5, 46, 'Created new post: Fashion', '2024-11-21 19:03:09'),
(6, 7, 43, 'Created new post: Make money', '2024-11-22 04:00:37'),
(7, 8, 43, 'Created new post: Does Human Brain Multifunctioning?', '2024-11-22 04:12:22'),
(8, 9, 47, 'Created new post: Exploring the World with Purpose', '2024-11-22 15:04:57'),
(13, 11, 47, 'Updated post: SpaceX Starship\'s Bold Leap!', '2024-11-24 06:48:46'),
(14, 11, 47, 'Updated post: SpaceX Starship\'s Bold Leap', '2024-11-24 12:23:10'),
(15, 15, 47, 'Created new post: 5 Personal Finance Habits to Master in 2024', '2024-11-24 12:30:22'),
(18, 17, 46, 'Created new post: Spider-Man: Across the Spider-Verse', '2024-11-25 06:51:15'),
(20, 17, 46, 'Updated post: Spider-Man: Across the Spider-Verse 2024', '2024-11-25 07:41:47'),
(21, 17, 46, 'Updated post: Spider-Man: Across the Spider-Verse', '2024-11-25 07:46:58'),
(22, 17, 46, 'Updated post: Spider-Man: Across the Spider-Verse 2024', '2024-11-25 07:48:28'),
(23, 17, 46, 'Updated post: Spider-Man: Across the Spider-Verse', '2024-11-25 07:48:46'),
(26, 17, 46, 'Updated post: Spider-Man: Across the Spider-Verse 2024', '2024-11-25 07:51:10'),
(27, 17, 46, 'Updated post: Spider-Man: Across the Spider-Verse ', '2024-11-25 08:04:29'),
(28, 11, 47, 'Updated post: SpaceX Starship\'s Bold Leap', '2024-11-25 08:17:40'),
(29, 10, 47, 'Updated post: Why Rest Is the New Productivity Hack', '2024-11-25 08:17:50'),
(30, 9, 47, 'Updated post: Exploring the World with Purpose', '2024-11-25 08:18:01');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `report_reason` text NOT NULL,
  `report_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `dismiss_reason` text DEFAULT NULL,
  `status` enum('pending','dismissed','resolved') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `post_id`, `user_id`, `report_reason`, `report_date`, `dismiss_reason`, `status`) VALUES
(3, 8, 47, 'kisu ekta', '2024-11-26 04:26:06', 'sdsdsda ', 'dismissed'),
(4, 12, 47, 'kjfhhjashahjac', '2024-11-26 05:35:45', 'pagol ni, nijer post e nije report kore', 'dismissed'),
(5, 12, 47, 'efkqjhfkjqpofj', '2024-11-26 05:37:08', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1001, 'admin'),
(1002, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES
(1001, 1),
(1001, 2),
(1001, 3),
(1001, 4),
(1002, 1);

-- --------------------------------------------------------

--
-- Table structure for table `search_history`
--

CREATE TABLE `search_history` (
  `search_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `search_query` varchar(255) NOT NULL,
  `search_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_token` varchar(255) DEFAULT NULL,
  `login_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_id`, `user_id`, `session_token`, `login_timestamp`, `logout_timestamp`) VALUES
(5, 47, 'dd4d3b587d3b7605b5fcd99ec53ac22b2c16f836e83478f04745437c2353d1e7', '2024-12-02 09:16:24', NULL),
(6, 46, '2eca02b3b57d91b4e45cd63719d5a2327633f0fb6525b4ba536d899667c8bfad', '2024-11-27 13:35:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subscription_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `email`, `subscription_date`) VALUES
(2, 'solocreeper02@gmail.com', '2024-11-10 04:46:17'),
(3, 'faruqsan05@gmail.com', '2024-11-10 04:47:45'),
(4, 'syphon.bd.ofc@gmail.com', '2024-11-10 04:48:15'),
(5, 'hasib22134@gmail.com', '2024-11-10 13:27:54'),
(6, 'kaua@gmail.com', '2024-11-10 13:43:27'),
(7, 'hululu@hotmail.com', '2024-11-11 02:05:39'),
(8, 'omor6263@gmail.com', '2024-11-12 02:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role_id` int(11) DEFAULT 1002,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive','banned') DEFAULT 'active',
  `user_otp` text DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `first_name`, `last_name`, `email`, `password_hash`, `created_at`, `role_id`, `registration_date`, `status`, `user_otp`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(43, 'galib99', 'Abdur', 'Galib', 'hasib22134@gmail.com', '$2y$10$qPUMfDF4jRqJ9Efy/yF92OEFlPCrXPSCXUN0.yy5pZLc3r2uUL/TW', '2024-11-16 07:11:08', 1002, '2024-11-16 07:11:08', 'active', NULL, NULL, NULL),
(46, 'DaakTicket', 'Daak', 'Ticket', 'daakticket05@gmail.com', '$2y$10$NFwV6Ntl0womvJai.kKGFeFApmcLR5U01RuGXGLog.sQWsOnhdx2G', '2024-11-16 17:38:50', 1001, '2024-11-16 17:38:50', 'active', NULL, NULL, NULL),
(47, 'omor6263', 'Omor', 'Faruq', 'omor6263@gmail.com', '$2y$10$0W1iEyehATGO.uj3.7rLneusMWgxVjlUoJswdnfIvSxP/sBUSRzTK', '2024-11-22 12:19:29', 1002, '2024-11-22 12:19:29', 'active', '$2y$10$KmqUuErxtBgOUPA3/oy/cerrv4aospJZvrIG9WjsawoS3tRv/Ptqq', NULL, '2024-12-02 10:21:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`profile_id`, `user_id`, `first_name`, `last_name`, `email`, `bio`, `profile_picture`, `facebook_link`, `twitter_link`, `instagram_link`, `linkedin_link`) VALUES
(11, 43, 'Abdur', 'Galib', 'hasib22134@gmail.com', '', 'assets/uploads/profile_pictures/profile_43.JPG', '', '', '', ''),
(13, 46, 'Daak', 'Ticket', 'daakticket05@gmail.com', 'As the admin of DaakTicket, I’m passionate about creating a vibrant platform where everyone can share, learn, and grow through meaningful discussions. I thrive on connecting diverse voices and encouraging exploration across topics like technology, lifestyle, personal finance, and beyond. \r\nMy goal is to ensure DaakTicket remains a welcoming space for insight. Let’s build this community together and bring fresh ideas to the platform!', 'assets/uploads/profile_pictures/profile_46.png', 'https://www.facebook.com/', 'https://x.com/', 'https://www.instagram.com/', 'https://www.linkedin.com/in/'),
(14, 47, 'Omor', 'Faruq', 'omor6263@gmail.com', 'I love exploring new ideas and sharing them through writing. I’m deeply interested in technology, food and travel and enjoy diving into creative projects that let me learn and grow. I value meaningful connections and believe in the power of storytelling to inspire and inform. Every day is an opportunity to learn something new and share it with the world!', 'assets/uploads/profile_pictures/profile_47.png', 'https://www.facebook.com/omorfaruq05', 'https://x.com/', 'https://www.instagram.com/kar____as/', 'https://www.linkedin.com/in/faruq-omor/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_actions`
--
ALTER TABLE `admin_actions`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`post_id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likes_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`media_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`),
  ADD UNIQUE KEY `permission_name` (`permission_name`);

--
-- Indexes for table `post_history`
--
ALTER TABLE `post_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`post_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `search_history`
--
ALTER TABLE `search_history`
  ADD PRIMARY KEY (`search_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_id`),
  ADD UNIQUE KEY `session_token` (`session_token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `fk_role_id` (`role_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_actions`
--
ALTER TABLE `admin_actions`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `audit_log`
--
ALTER TABLE `audit_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `media_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_history`
--
ALTER TABLE `post_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT for table `search_history`
--
ALTER TABLE `search_history`
  MODIFY `search_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_actions`
--
ALTER TABLE `admin_actions`
  ADD CONSTRAINT `admin_actions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `audit_log`
--
ALTER TABLE `audit_log`
  ADD CONSTRAINT `audit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD CONSTRAINT `blog_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_post_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `post_history`
--
ALTER TABLE `post_history`
  ADD CONSTRAINT `post_history_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_history_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`) ON DELETE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`post_id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`permission_id`) ON DELETE CASCADE;

--
-- Constraints for table `search_history`
--
ALTER TABLE `search_history`
  ADD CONSTRAINT `search_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE SET NULL;

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
