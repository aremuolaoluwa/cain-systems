-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2024 at 10:19 AM
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
-- Database: `capp`
--

-- --------------------------------------------------------

--
-- Table structure for table `clockin`
--

CREATE TABLE `clockin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `clock_in_time` datetime NOT NULL,
  `clock_out_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clockin`
--

INSERT INTO `clockin` (`id`, `username`, `clock_in_time`, `clock_out_time`) VALUES
(1, 'admin', '2024-06-11 17:02:01', NULL),
(2, 'admin', '2024-06-13 14:10:51', NULL),
(3, 'admin', '2024-06-13 14:12:29', NULL),
(4, 'ade', '2024-06-13 16:39:02', NULL),
(5, 'joe', '2024-06-20 13:23:24', '2024-06-20 00:00:00'),
(6, 'joe', '2024-06-20 14:06:27', NULL),
(7, 'joe', '2024-06-20 14:06:31', NULL),
(8, 'joe', '2024-06-20 14:13:44', NULL),
(9, 'joe', '2024-06-20 14:13:50', NULL),
(10, 'marie', '2024-06-28 15:04:26', NULL),
(11, 'admin', '2024-07-11 11:10:07', NULL),
(12, 'johns', '2024-07-12 11:26:10', NULL),
(13, 'b_adeyemi', '2024-07-25 11:30:04', NULL),
(14, 'jerry_d', '2024-07-29 14:40:21', NULL),
(15, 'olaoluwa', '2024-07-30 15:47:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clockout`
--

CREATE TABLE `clockout` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `clock_out_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clockout`
--

INSERT INTO `clockout` (`id`, `username`, `clock_out_time`) VALUES
(1, 'joe', '2024-06-20 15:02:44'),
(2, 'marie', '2024-06-28 15:04:44'),
(3, 'admin', '2024-07-11 11:10:18'),
(4, 'johns', '2024-07-12 11:26:40'),
(5, 'b_adeyemi', '2024-07-25 12:10:56'),
(6, 'jerry_d', '2024-07-29 14:40:34'),
(7, 'olaoluwa', '2024-07-30 15:47:34');

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` enum('student','staff') NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `password` varchar(255) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`username`, `firstname`, `lastname`, `email`, `phone`, `role`, `gender`, `password`, `registration_date`, `reset_token`) VALUES
('anishere_e', 'Esther', 'Anishere ', 'example@mail.com', '080', 'student', 'female', '$2y$10$6gWdT/xelLVX66PE9.vWGOhb8edC3RZZLWhBIs4R9bis/4DN3G1DC', '2024-08-09 12:08:57', ''),
('a_abdulmalik', 'Abdulquadri', 'Abdulmalik', 'example@mail.com', '080', 'student', 'male', '$2y$10$94ohu6DFpU08O.b.pHSICuD86YPYwxs3x1F2hRLsU1z.Yy3A57aPq', '2024-08-09 12:04:31', ''),
('a_abdulsalam', 'Aliyah', 'Abdulsalam', 'example@mail.com', '080', 'student', 'female', '$2y$10$iRPtgfiiuMoZAYO9Kap53uJRvx6Le3OnrX1UzroHhZ0B/EfuknDMq', '2024-08-09 11:28:55', ''),
('a_ayeni', 'Aisha ', 'Ayeni', 'example@mail.com', '080', 'student', 'female', '$2y$10$zo3Es/Uryv6dtEJKnvD4h.YeqSxFeu1Wfb5JgKd5IRYnibX6yowo6', '2024-08-09 12:52:32', ''),
('a_jeremiah', 'Jeremiah', 'Adande', 'example@mail.com', '080', 'student', 'male', '$2y$10$LnXILIZ/n/aq3CgVhIvco.ryVVNJIVS3XOEaFKv36W91ehlf45Yai', '2024-08-09 11:40:22', ''),
('a_oloojo', 'Ameedat', 'Oloojo', 'example@mail.com', '080', 'student', 'female', '$2y$10$1kfo9mdy8fvjSmC6UPvaAOLc17spA9MNK5yziTXI0dHhuUP.W7Hd6', '2024-08-09 11:43:02', ''),
('a_shoyinka', 'Aishat', 'Shoyinka', 'example@mail.com', '080', 'student', 'female', '$2y$10$8MgLhru2447W/xxWf14lNO1tYxDswsR4Gzk1HCfEgl2Gobiu1jqxS', '2024-08-09 13:00:03', ''),
('b_adeoba', 'Busolami', 'Adeoba', 'example@mail.com', '080', 'student', 'female', '$2y$10$zTnm2JIe88W9pX5vElxuBeG7liNk.6pJEuCwxhcQD3KZXrONocu6m', '2024-08-09 12:05:14', ''),
('b_akinbode', 'Blessing', 'Akinbode', 'example@mail.com', '080', 'student', 'female', '$2y$10$2M5MH22luAb/dznd24E0W.t/yBwG6w/YkGjagXfZvvSylsRqcCkN2', '2024-08-09 12:08:10', ''),
('c_isagbah', 'Chinedu', 'Isagbah', 'jesseisagbah@cainafrica.org', '08068374541', 'staff', 'male', '$2y$10$bfmQcsnLv.SrXRxr.1XwI.Cr53hqJBdCZi0Jy18eaPKyNWh/u.7SS', '2024-08-09 11:19:13', ''),
('c_john', 'Chisom', 'John', 'example@mail.com', '080', 'student', 'female', '$2y$10$SF6Fw2UzYFlpLbUjHPQ5D.8QEvmMG7uiKbZBF5tfOoe4FN6JmY5dy', '2024-08-09 12:53:49', ''),
('d_aduragbemi', 'Darasola', 'Aduragbemi', 'example@mail.com', '080', 'student', 'female', '$2y$10$bputBacVNxa102c0KsfmKecg0upp94Q0pFixhKyg8kPCMCLr001/C', '2024-08-09 12:42:51', ''),
('d_oshiogia', 'Daniel', 'Oshiogia', 'example@mail.com', '080', 'student', 'male', '$2y$10$yBeR.KLABv6KxhjWscSMJ.LnSC3k/45p4d1lo5bMRn2oA/QSBuB8.', '2024-08-09 11:44:42', ''),
('ez_anishere', 'Ezekiel', 'Anishere', 'example@mail.com', '080', 'student', 'male', '$2y$10$xEYS4UbFh1SR0NjrYTW85OcCMo.vDtZ2gnOeGaHFrDQAg7jSDVLYK', '2024-08-09 12:46:30', ''),
('e_adepoju', 'Elizabeth', 'Adepoju', 'example@mail.com', '080', 'student', 'female', '$2y$10$y19MGNQ0QEFqkwkYu.YFUubOfjZpswNJCB81VvzVlHzX21/wrtYI.', '2024-08-09 12:06:10', ''),
('e_anishere', 'Emmanuel', 'Anishere', 'example@mail.com', '080', 'student', 'male', '$2y$10$wI2tH.DfGorNFvlK7OMBnu4rjtiFYU8jkC/r6NEMookRla3aqLWeu', '2024-08-09 11:51:14', ''),
('e_olorunfemi', 'Ebenezer', 'Olorunfemi', 'example@mail.com', '080', 'student', 'male', '$2y$10$incXNlXi8CTD2haVgbjHseu6js51ApXy.kEjC2qqpY/Bnm/yk9HdW', '2024-08-09 12:59:29', ''),
('e_shobowale', 'Eniola', 'Shobowale', 'example@mail.com', '080', 'student', 'female', '$2y$10$6WICi5Wq3w76Jv78RkpTVe3YVyLAcCDL04bVHoL8VqwAK5SD4kiC6', '2024-08-09 11:47:10', ''),
('f_adesanya', 'Fawas', 'Adesanya', 'example@mail.com', '080', 'student', 'male', '$2y$10$E3LJ587VuGkLXFjGYYrrY.oU96.POg6sXLGWPcNSiUATYKQ5jHgYu', '2024-08-09 12:06:55', ''),
('f_aliphosus', 'Favour', 'Aliphosus', 'example@mail.com', '080', 'student', 'female', '$2y$10$W5dRaW60.fjukLQxPtnjqurlv52C49Lkg573RDII05UUm27D7BIfG', '2024-08-09 11:39:00', ''),
('f_bamidele', 'Femi', 'Bamidele', 'deyviedphemmie@gmail.com', '08148366399', 'staff', 'male', '$2y$10$vLR3S.SK9r3pE5QRcLnllu5m4/yKb082Ff1iFPJZjTR1e/tL4AKda', '2024-08-09 11:03:39', ''),
('f_oshodi', 'Fareed', 'Oshodi', 'example@mail.com', '080', 'student', 'male', '$2y$10$LZQ2c7LS7zwbIe.3bngAxO5OFadtNPh0zjEU7vBevDEfdmxwy5/W2', '2024-08-09 11:46:04', ''),
('f_taofeeq', 'Fatiah', 'Toafeeq', 'example@mail.com', '080', 'student', 'female', '$2y$10$GVcRqLsHEaTmnPumTg25L.DjlMYVsTZpUCqfUjPu72XvCzppgoAF.', '2024-08-09 12:55:42', ''),
('g_anishere', 'Grace', 'Anishere', 'example@mail.com', '080', 'student', 'female', '$2y$10$FQCYqLTAjD8aihFh0VUrk.jCDq7Nxfm2C2DsLYOPOuzbJlwmNOaAO', '2024-08-09 11:29:40', ''),
('g_leji', 'Gbemisola', 'Leji', 'example@mail.com', '080', 'student', 'female', '$2y$10$JBodeFOnc06CMH8Vy23Ov.l94RtPVrqCbs0k1REGcbfiIWUbIWdiK', '2024-08-09 12:55:08', ''),
('h_aderogba', 'Habeebat', 'Aderogba', 'example@mail.com', '080', 'student', 'female', '$2y$10$MtwCAHLLEQrbw6gmv1L6W.xAu7rfZWAp9hw/6epU18AsVf/ysO6EO', '2024-08-09 12:41:05', ''),
('j_adande', 'Joy', 'Adande', 'example@mail.com', '080', 'student', 'female', '$2y$10$7ncM/8K0/aYPVfe3WYC/cOYje7v2uTM/q/AtULXSjdSM3GyI4i1qG', '2024-08-09 11:38:13', ''),
('j_aremu', 'Joseph', 'Aremu', 'josepharemu@cainafrica.org', '07042750757', 'staff', 'male', '$2y$10$bjujQ25Dkzu6a.D1O6VSG.LEWETafquTeV4KXng/EE680KH3p4y9G', '2024-08-09 11:18:10', ''),
('j_timothy', 'Janet', 'Timothy', 'example@mail.com', '080', 'student', 'female', '$2y$10$SGAIPCccbOrzyDulCunbduecBydDf2hXhvMK.RKsHc8L6xo36Rw8C', '2024-08-09 11:48:16', ''),
('m_john', 'Munachi', 'John', 'example@mail.com', '080', 'student', 'female', '$2y$10$/NP0IBjtEeN2kEpSBTtAzurrGmAS/.zN3dihFd8QvQNXaE7TNDAHe', '2024-08-09 12:09:41', ''),
('m_nnoruka', 'Michael', 'Nnoruka', 'example@mail.com', '080', 'student', 'male', '$2y$10$AH15hLT1Kv7C29I9XC3iiOXaKFGo/lN.PgUPrHvbbTsEZgjYNziNe', '2024-08-09 12:56:20', ''),
('m_obe', 'Mayowa', 'Obe', 'obeolumayowa@gmail.com', '09066718952', 'staff', 'male', '$2y$10$VnkP486dKjKsosNgV/Y5heBCvChPL7BskPKr0my0Tu5f0FKsgajSC', '2024-08-09 11:07:02', ''),
('m_ojedayo', 'Miracle', 'Ojedayo', 'Miracleojedayo@gmail.com', 'nil', 'staff', 'female', '$2y$10$NJ0JUdOAx/ChybHpSKIJ6uN1/sjD.kDlNJ2s4622ZjzgDrqWrbAKu', '2024-08-09 11:20:05', ''),
('m_olatunbosun', 'Mary-Clara', 'Olatunbosun', 'example@mail.com', '080', 'student', 'female', '$2y$10$65/SiSqEIhujDAsdQlpIzOWtvK.LCuO3pqdfikSzp7usAg0MF7ive', '2024-08-09 11:31:41', ''),
('m_onabanjo', 'Michael', 'Onabanjo', 'example@mail.com', '080', 'student', 'male', '$2y$10$m8NzSHBzkNcy0iHLPAxrH.qfBTV2BuMaf3efv2mx/gaqnmqMSVgQu', '2024-08-09 12:11:36', ''),
('n_olatunbosun', 'Naomi', 'Olatunbosun', 'example@mail.com', '080', 'student', 'female', '$2y$10$nNTFLla60WZQHMUV0xpkoe0qOvx8ZswkN6qrSxF8BkaIvwnYBA9qq', '2024-08-09 12:10:44', ''),
('n_quadri', 'Noimot', 'Quadri', 'example@mail.com', '080', 'student', 'female', '$2y$10$eR7RnKp.uM2XJQNhr.AcsuWiRVdAFocUTVU5EiGQeS9wumjIB/zEe', '2024-08-09 12:58:50', ''),
('n_sussan', 'Sussan', 'Nnoruka', 'example@mail.com', '080', 'student', 'female', '$2y$10$KzLFik2L3Sm4trul/apKWOqkQa2PQ7treor8HiDizJRCO/bZrspiG', '2024-08-09 12:56:56', ''),
('o_abdulwahab', 'Olayemi', 'Abdulwahab', 'rasheedatolayemi04@gmail.com', '08148878623', 'staff', 'female', '$2y$10$pEQpnfpwV7Ql1FFNCfL4Oeh3.asIXW5fGb9eKk1gll2.136T208xu', '2024-08-09 11:15:47', ''),
('o_adande', 'Odunayo', 'Adande', 'example@mail.com', '080', 'student', 'female', '$2y$10$Y9nHEb8PjuZ3LprjNGGCm.hNzBSuaY.kMQGSh0ng9ess/CkWrKggm', '2024-08-09 12:15:10', ''),
('o_okwuchukwu', 'Ozioma', 'Okwuchukwu', 'example@mail.com', '080', 'student', 'female', '$2y$10$PyN6mgXR9xkYYJfNXbk01ucdfpUD0.7PzKPh7SU7Bxn6/snq6KDaK', '2024-08-09 11:30:46', ''),
('o_shalom', 'Olusegun', 'Shalom', 'example@mail.com', '080', 'student', 'male', '$2y$10$iLx//4eoTklEktUVRWXAIOujIiJcCTZAJbvPfUkSGQ5Nzi5eB9aA.', '2024-08-09 11:26:51', ''),
('o_showunmi', 'Omoyemi', 'Showunmi', 'example@mail.com', '080', 'student', 'female', '$2y$10$H8lDZ1pjJnDgVWgGMG/lEu3dm0ESTO7cBDviClXUrsdWSv/yyjQO6', '2024-08-09 12:00:54', ''),
('p_babalola', 'Peter', 'Babalola', 'example@mail.com', '080', 'student', 'male', '$2y$10$dyms8oH2zZpQrbBPDydzgesCLryVaD.G8sT1BGzVT2uC4GSjyjHkW', '2024-08-09 11:49:56', ''),
('p_fashina', 'Peace', 'Fashina', 'peacefashina@gmail.com', 'nil', 'staff', 'female', '$2y$10$jjOMJTNOgdOBU0wH15ocVePHI3QgzIsbD.eQqHyVUx38ZXNVVDq.m', '2024-08-09 11:11:13', ''),
('p_lasis', 'Praise', 'Lasis', 'example@mail.com', '080', 'student', 'male', '$2y$10$ZMcSCXG42j629u8vjPdYYOLDUC/F66N881TPOaSRPMWvR9zsBDvCK', '2024-08-09 11:36:41', ''),
('q_braimah', 'Queen Treasure', 'Braimah', 'example@mail.com', '080', 'student', 'female', '$2y$10$xBNM0TReO7hxLinzrN3H2udQ60yOOZx9bIAN5HmlN2p70nkjOdb02', '2024-08-09 11:59:47', ''),
('r_asagba', 'Ruke', 'Asagba', 'rukeasgba@cainafrica.org', '07062257409', 'staff', 'female', '$2y$10$r.ENBrBUhzg53082VPxhO.emVIs1RIiBESvmddNWZNOWPMY21rMYa', '2024-08-09 11:20:58', ''),
('r_korede', 'Raji', 'Korede', 'example@mail.com', '080', 'student', 'male', '$2y$10$0oSCPZFzDlIHJriHPZj8j.EfjOJk1Vaa49grmTorS4AtBK4BoxTk.', '2024-08-09 12:14:00', ''),
('r_waheed', 'Rofiat', 'Waheed', 'example@mail.com', '080', 'student', 'female', '$2y$10$VjdLqWVABQqzvvQlxxMiJOBpuzYjJsIg.0ClnkjTs1jGb8gKj1sgK', '2024-08-09 11:33:15', ''),
('s_abdulwahab', 'Sekinat', 'Abdulwahab', 'example@mail.com', '080', 'student', 'female', '$2y$10$7JghAU87.3kWZaS0OpLKIOZ27HG.l556Opp.vAhP.P.xyGSspXjVy', '2024-08-09 11:37:35', ''),
('s_babalola', 'Sussana', 'Babalola', 'example@mail.com', '080', 'student', 'female', '$2y$10$KqEvZAJjBe1vASU5pG6cB.tEc.OKUxZXYzP2RdV2i9z0Fz8oExQ9W', '2024-08-09 12:58:19', ''),
('s_oladokun', 'Semilogo', 'Oladokun', 'example@mail.com', '080', 'student', 'male', '$2y$10$N17PD7.hA2AMAzEL6HySMefbkyQEzuwkSUFYSV8BL.FwXNPyIzPyG', '2024-08-09 11:41:11', ''),
('t_agbelade', 'Temitope', 'Agbelade', 'example@mail.com', '080', 'student', 'female', '$2y$10$.s5pMZOTv2cRme18RSxYfeCo4FZU5r/oXnD7oS5ncW3mGK4UuGZ1O', '2024-08-09 12:57:45', ''),
('t_edward', 'Tomiwa', 'Edward', 'example@mail.com', '080', 'student', 'male', '$2y$10$AQMId67R.hp5wNcJzg6D.ucrZhgysCzDKAXGKakn7.tVL.x70si0y', '2024-08-09 12:53:05', ''),
('t_lawal', 'Tobi', 'Lawal', 'example@mail.com', '080', 'student', 'male', '$2y$10$VGwN.ABn2obvrhafYeMtgeMWlDR7CmQxx99.FHRZh0JRGQOFjsSOG', '2024-08-09 12:14:35', ''),
('t_tejuoso', 'Toluwani', 'Tejuoso', 'example@mail.com', '080', 'student', 'female', '$2y$10$CWiG5NdF1.jpOeZe06p9JeXED8MUjduSCHdgdvAkeVlYqn3QkmeZC', '2024-08-09 13:00:33', ''),
('w_adesanya', 'Waris', 'Adesanya', 'example@mail.com', '080', 'student', 'male', '$2y$10$TK9OtF5tKRa.G7ba2nuHzu8n3GvGo31Cp4nG0GQfbabwfpG2nBCsW', '2024-08-09 11:52:24', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clockin`
--
ALTER TABLE `clockin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clockout`
--
ALTER TABLE `clockout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clockin`
--
ALTER TABLE `clockin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `clockout`
--
ALTER TABLE `clockout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
