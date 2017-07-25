-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2017 at 06:51 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scopus`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `app_id` int(10) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `emailad` varchar(100) NOT NULL,
  `phoneno` varchar(12) DEFAULT NULL,
  `college` varchar(50) NOT NULL,
  `curposition` varchar(50) NOT NULL,
  `appposition` varchar(50) NOT NULL,
  `dateolp` date NOT NULL,
  `dateoap` date NOT NULL,
  `publications` varchar(10000) NOT NULL,
  `publications_url` varchar(10000) DEFAULT NULL,
  `publication_score` int(10) NOT NULL,
  `approval_status` tinyint(1) NOT NULL,
  `comments` varchar(5000) DEFAULT NULL,
  `dateofint` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`app_id`, `fullname`, `emailad`, `phoneno`, `college`, `curposition`, `appposition`, `dateolp`, `dateoap`, `publications`, `publications_url`, `publication_score`, `approval_status`, `comments`, `dateofint`) VALUES
(9, 'Sanjay misra', 'laleyeolamide@yahoo.com', '', 'NONE', 'SL', 'PR', '2009-05-05', '2017-07-16', 'Solving manufacturing cell design problems by using a dolphin echolocation algorithm__An approach to solve the Set Covering Problem with the Soccer League Competition algorithm__Finding solutions of the set covering problem with an Artificial Fish Swarm Algorithm Optimization__Co-FAIS: Cooperative fuzzy artificial immune system for detecting intrusion in wireless sensor networks__A scheduling problem for software project solved with ABC metaheuristic__Motivating effective ICT users’ support through automated mobile Edu-Helpdesk system__Software project scheduling using the Hyper-Cube ant colony optimization algorithm__Network system design for combating cybercrime in Nigeria__Message from the program chairs__Autonomous tuning for constraint programming via artificial bee colony optimization__Computational science and its applications – ICCSA 2015: 15th international conference banff, AB, Canada, june 22–25, 2015 proceedings, Part I__Implementing a web-based immunization schedule reminder for postnatal service delivery__Computational science and its applications - ICCSA 2015: 15th international conference Banff, AB, Canada, June 22-25, 2015 proceedings, part v__A binary fruit fly optimization algorithm to solve the set covering problem__Computational science and its applications – ICCSA 2015: 15th international conference banff, AB, Canada, june 22-25, 2015 proceedings, Part IV__Comparing cuckoo search, bee colony, firefly optimization, and electromagnetism-like algorithms for solving the set covering problem__Computational science and its applications – ICCSA 2015: 15th international conference Banff, AB, Canada, June 22–25, 2015 proceedings, part III__A comparison of three recent nature-inspired metaheuristics for the set covering problem__A baseline domain specific language proposal for model-driven web engineering code generation__Solving the set covering problem with a binary black hole inspired algorithm__', 'https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84978200196&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84978804635&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84978792180&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84900453631&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84949033229&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85018209070&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84946059895&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84978245459&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84893227922&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84948979394&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84948947080&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85020292035&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84948995259&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84948947184&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84948957061&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84948971651&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84944463940&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84949035299&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84978209261&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84978796141&origin=inward__', 89, 1, '', '2017-07-30'),
(22, 'adewole adewumi', 'laleyeolamide@yahoo.com', '', 'CST', 'L2', 'L1', '2016-02-02', '2017-07-25', 'Mobile-based emergency report and response system for academic institutions of developing countries__Implementing a web-based immunization schedule reminder for postnatal service delivery__Quantitative quality model for evaluating open source web applications: Case study of repository software__Complexity metrics for cascading style sheets__Tool support for Cascading Style Sheets’ complexity metrics__Evaluating open source software quality models against ISO 25010__Industrial minerals potentials of Ijero pegmatite in Ekiti state, Southwestern Nigeria__Design and development of a digital identity framework for Nigeria__Computational and mathematical modelling: Applicability to infectious disease control in Africa__A cloud-based retail management system__Usability evaluation of mobile access to institutional repository__Design and implementation of a mobile based timetable filtering system__An experimental validation of public cloud mobile banking__Evaluation of hadoop/mapreduce framework migration tools__Design and implementation of an online examination system for grading objective and essay-type questions__An analysis of scripting languages for research in applied computing__Adapted cloudlet for mobile distance learning: Design, prototype and evaluation__Development of an automated E-campus system__A systematic literature review of open source software quality assessment models__Applicability of cyclomatic complexity on WSDL__', 'https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85020262499&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85020292035&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84900355227&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84863959098&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84930452996&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84964264797&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84892840533&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85006944594&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84991108628&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84930461671&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85018203865&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85006952358&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84906751124&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84988293945&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85006961513&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84900369759&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84965079844&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85006914049&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84994748457&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84930439892&origin=inward__', 35, 0, ' Three years experience as  Lecturer II is Required', NULL),
(23, 'Ambrose azeta', 'laleyeolamide@yahoo.com', '', 'CST', 'SL', 'AP', '2013-08-05', '2017-07-25', 'Adapted cloudlet for mobile distance learning: Design, prototype and evaluation__Development of an automated E-campus system__Motivating effective ICT users’ support through automated mobile Edu-Helpdesk system__Closing institutional gaps through academic research management system and implications in Nigeria__An anti-cultism social education media system__A Voice-Enabled framework for recommender and adaptation systems in E-learning__Voice-based e-learning approach for e-government__Application of VoiceXML in e-learning systems__Tuberculosis-Diagnostic Expert System: An architecture for translating patients information from the web for use in tuberculosis diagnosis__Comparative analysis and review of interactive voice response systems__Enhancing educational learning with social network platform__Developing a secure integrated e-Voting system__A review of open &amp; distance education and human development in Nigeria__A software engineered voice-enabled job recruitment portal system__Analytical solution of the schwartz - moon growth option model revisited__Implementation of \'ASR4CRM\': An automated speech-enabled customer care service system__Developing e-examination voice interface for visually impaired students in open and distance learning context__Development of an E-learning web portal: The foss approach__Predicting the adoption of e-learning management system: A case of selected private universities in Nigeria__E-Democracy: An enabler for improved participatory democracy__', 'https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84965079844&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85006914049&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85018209070&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85018211556&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84929353338&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84898085628&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84898137110&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84898179250&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84912019375&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85019989301&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84940121957&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84898216912&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84920449430&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=54149084759&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84932649821&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=65449126711&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85019971091&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=42149183712&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85017452083&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84900270970&origin=inward__', 44, 1, '', '2017-08-08'),
(24, 'ibukun afolabi', 'laleyeolamide@yahoo.com', '', 'CST', 'L1', 'SL', '2011-07-02', '2017-07-25', 'Using ontology-based information extraction for subject-based auto-grading__Improving rural healthcare delivery in Nigeria using distributed expert system technology__Heuristic evaluation of an institutional E-learning system: A Nigerian case__', 'https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84887673135&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=84940834144&origin=inward__https://www.scopus.com/inward/record.uri?partnerID=HzOxMe3b&scp=85016453492&origin=inward__', 5, 0, 'You did not meet the required Total publication post for this position', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`app_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `app_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
