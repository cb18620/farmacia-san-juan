

--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT 0,
  `brand_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`) VALUES
(6, 'DROGUERIA INTI', 1, 1),
(7, 'SAE S.A', 1, 1),
(8, 'FL PHARMA', 1, 1),
(9, 'IFA', 1, 1),
(10, 'ALCOS', 1, 1),
(11, 'DISMEFAR', 1, 1),
(12, 'DISMEDISUR', 1, 1),


-- Estructura de tabla para la tabla `categories`

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT 0,
  `categories_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`) VALUES
(6, 'JARABES', 1, 1),
(7, 'AEROSOL', 1, 1),
(8, 'COMPRIMIDOS', 1, 1),
(9, 'COMPRIMIDOS MASTICABLES', 1, 1),


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(15) NOT NULL,
  `uno` varchar(50) NOT NULL,
  `orderDate` date NOT NULL,
  `clientName` text NOT NULL,
  `projectName` varchar(30) NOT NULL,
  `clientContact` int(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `subTotal` int(100) NOT NULL,
  `totalAmount` int(100) NOT NULL,
  `discount` int(100) NOT NULL,
  `grandTotalValue` int(100) NOT NULL,
  `gstn` int(100) NOT NULL,
  `paid` int(100) NOT NULL,
  `dueValue` int(100) NOT NULL,
  `paymentType` int(15) NOT NULL,
  `paymentStatus` int(15) NOT NULL,
  `paymentPlace` int(5) NOT NULL,
  `delete_status` tinyint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `uno`, `orderDate`, `clientName`, `projectName`, `clientContact`, `address`, `subTotal`, `totalAmount`, `discount`, `grandTotalValue`, `gstn`, `paid`, `dueValue`, `paymentType`, `paymentStatus`, `paymentPlace`, `delete_status`) VALUES
(290, 'VENTA N°-0001', '2023-11-12', '', '', 0, '', 20, 20, 0, 20, 0, 0, 20, 2, 1, 0, 0),
(291, 'VENTA N°-000291', '2023-11-12', '', '', 0, '', 45, 45, 0, 45, 0, 0, 45, 2, 1, 0, 0),
(292, 'VENTA N°-000292', '2023-11-12', '', '', 0, '', 80, 80, 0, 80, 0, 0, 80, 2, 1, 0, 0),
(293, 'VENTA N°-000293', '2023-11-12', '', '', 0, '', 70, 70, 0, 70, 0, 0, 70, 2, 1, 0, 0),

-- Estructura de tabla para la tabla `order_item`
--

CREATE TABLE `order_item` (
  `id` int(15) NOT NULL,
  `productName` int(100) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `lastid` int(50) NOT NULL,
  `added_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `order_item`
--

INSERT INTO `order_item` (`id`, `productName`, `quantity`, `rate`, `total`, `lastid`, `added_date`) VALUES
(319, 690, '1', '20', '20.00', 290, '2023-11-12'),
(320, 690, '1', '20', '20.00', 291, '2023-11-12'),
(321, 691, '1', '25', '25.00', 291, '2023-11-12'),
(322, 690, '1', '20', '20.00', 292, '2023-11-12'),
(323, 691, '1', '25', '25.00', 292, '2023-11-12'),
(324, 692, '1', '35', '35.00', 292, '2023-11-12'),
(325, 692, '1', '35', '35.00', 293, '2023-11-12'),


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `mrp` int(100) NOT NULL,
  `bno` varchar(50) NOT NULL,
  `expdate` date NOT NULL,
  `added_date` date NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `nombre_comercial` varchar(100) NOT NULL,
  `principio_activo` varchar(100) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `rate_compra` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `quantity`, `rate`, `mrp`, `bno`, `expdate`, `added_date`, `active`, `status`, `nombre_comercial`, `principio_activo`, `accion`, `rate_compra`) VALUES
(690, 'PARACETAMOL', '', 6, 8, '1', '20', 0, '435534', '2023-11-30', '2023-11-01', 1, 1, 'NOMBRE COMERCIAL', 'IBUPROFENO', 'ANLGESICO', '15'),
(691, 'IBUPROFENO', '', 6, 8, '4', '25', 0, '4RTWERT', '2023-11-29', '2023-11-01', 1, 1, 'NOMBRE COMERCIAL', 'IBU', 'CABEZA', '20'),
(692, 'DOLOCTORINA', '', 6, 8, '23', '35', 0, 'RFEW324', '2023-11-28', '2023-11-01', 1, 1, 'DOLOR DE MUELA', 'DOLC', 'CALMA EL DOLOR DE MUELA', '30'),
(693, 'otro', '', 6, 6, '30', '2.50', 0, 'uiouoi', '2023-11-30', '2023-11-12', 1, 1, 'otro', 'otro', 'dolro', '1'),
(694, 'compulx', '', 11, 11, '49', '11.90', 0, 'yjf67', '2023-11-18', '2023-11-12', 1, 1, 'compulx', 'compulx', 'compulx', '11.50'),
(695, 'PARACETAMOL', '', 6, 8, '1', '20', 0, '234', '2024-01-18', '2024-01-04', 1, 1, 'NOMBRE COMERCIAL', 'IBUPORFENO', 'ANLGESICO', '15'),
(696, 'PARACETAMOL', '', 6, 8, '1', '20', 0, '3213', '2024-01-18', '2024-01-04', 1, 1, 'NOMBRE COMERCIAL', 'IBUPROFENO', 'ANLGESICO', '15'),
(697, 'IBUPROFENO', '', 6, 8, '14', '20', 0, '2R3', '2024-01-18', '2024-01-04', 1, 1, 'NOMBRE COMERCIAL', 'IBUPROFENO', 'ANLGESICO', '15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'admin', '7dd2259de9fef85fa6a0a04423a0dbc6', 'nowdemy@sample.com'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(3, 'carlos', 'dc599a9972fde3045dab59dbd1ae170b', 'carlos@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;

--
-- AUTO_INCREMENT de la tabla `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=698;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

