<?php

return [

	/*
		    |--------------------------------------------------------------------------
		    | Validation Language Lines
		    |--------------------------------------------------------------------------
		    |
		    | The following language lines contain the default error messages used by
		    | the validator class. Some of these rules have multiple versions such
		    | as the size rules. Feel free to tweak each of these messages here.
		    |
	*/
	'accepted' => 'El campo :attribute debe ser aceptado.',
	'active_url' => 'El campo :attribute no es una URL válida.',
	'after' => 'El campo :attribute debe ser una fecha posterior a :date.',
	'after_or_equal' => 'El campo :attribute debe ser una fecha posterior o igual a :date.',
	'alpha' => 'El campo :attribute solo puede contener letras.',
	'alpha_dash' => 'El campo :attribute solo puede contener letras, números, guiones y guiones bajos.',
	'alpha_num' => 'El campo :attribute solo puede contener letras y números.',
	'array' => 'El campo :attribute debe ser un array.',
	'before' => 'El campo :attribute debe ser una fecha anterior a :date.',
	'before_or_equal' => 'El campo :attribute debe ser una fecha anterior o igual a :date.',
	'between' => [
		'numeric' => 'El campo :attribute debe ser un valor entre :min y :max.',
		'file' => 'El archivo :attribute debe pesar entre :min y :max kilobytes.',
		'string' => 'El campo :attribute debe contener entre :min y :max caracteres.',
		'array' => 'El campo :attribute debe contener entre :min y :max elementos.',
	],
	'boolean' => 'El campo :attribute debe ser verdadero o falso.',
	'confirmed' => 'El campo confirmación de :attribute no coincide.',
	'date' => 'El campo :attribute no corresponde con una fecha válida.',
	'date_equals' => 'El campo :attribute debe ser una fecha igual a :date.',
	'date_format' => 'El campo :attribute no corresponde con el formato de fecha :format.',
	'different' => 'Los campos :attribute y :other deben ser diferentes.',
	'digits' => 'El campo :attribute debe ser un número de :digits dígitos.',
	'digits_between' => 'El campo :attribute debe contener entre :min y :max dígitos.',
	'dimensions' => 'El campo :attribute tiene dimensiones de imagen inválidas.',
	'distinct' => 'El campo :attribute tiene un valor duplicado.',
	'email' => 'El campo :attribute debe ser una dirección de correo válida.',
	'ends_with' => 'El campo :attribute debe finalizar con alguno de los siguientes valores: :values',
	'exists' => 'El campo :attribute seleccionado no existe.',
	'file' => 'El campo :attribute debe ser un archivo.',
	'filled' => 'El campo :attribute debe tener un valor.',
	'gt' => [
		'numeric' => 'El campo :attribute debe ser mayor a :value.',
		'file' => 'El archivo :attribute debe pesar más de :value kilobytes.',
		'string' => 'El campo :attribute debe contener más de :value caracteres.',
		'array' => 'El campo :attribute debe contener más de :value elementos.',
	],
	'gte' => [
		'numeric' => 'El campo :attribute debe ser mayor o igual a :value.',
		'file' => 'El archivo :attribute debe pesar :value o más kilobytes.',
		'string' => 'El campo :attribute debe contener :value o más caracteres.',
		'array' => 'El campo :attribute debe contener :value o más elementos.',
	],
	'image' => 'El campo :attribute debe ser una imagen.',
	'in' => 'El campo :attribute es inválido.',
	'in_array' => 'El campo :attribute no existe en :other.',
	'integer' => 'El campo :attribute debe ser un número entero.',
	'ip' => 'El campo :attribute debe ser una dirección IP válida.',
	'ipv4' => 'El campo :attribute debe ser una dirección IPv4 válida.',
	'ipv6' => 'El campo :attribute debe ser una dirección IPv6 válida.',
	'json' => 'El campo :attribute debe ser una cadena de texto JSON válida.',
	'lt' => [
		'numeric' => 'El campo :attribute debe ser menor a :value.',
		'file' => 'El archivo :attribute debe pesar menos de :value kilobytes.',
		'string' => 'El campo :attribute debe contener menos de :value caracteres.',
		'array' => 'El campo :attribute debe contener menos de :value elementos.',
	],
	'lte' => [
		'numeric' => 'El campo :attribute debe ser menor o igual a :value.',
		'file' => 'El archivo :attribute debe pesar :value o menos kilobytes.',
		'string' => 'El campo :attribute debe contener :value o menos caracteres.',
		'array' => 'El campo :attribute debe contener :value o menos elementos.',
	],
	'max' => [
		'numeric' => 'El campo :attribute no debe ser mayor a :max.',
		'file' => 'El archivo :attribute no debe pesar más de :max kilobytes.',
		'string' => 'El campo :attribute no debe contener más de :max caracteres.',
		'array' => 'El campo :attribute no debe contener más de :max elementos.',
	],
	'mimes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
	'mimetypes' => 'El campo :attribute debe ser un archivo de tipo: :values.',
	'min' => [
		'numeric' => 'El campo :attribute debe ser al menos :min.',
		'file' => 'El archivo :attribute debe pesar al menos :min kilobytes.',
		'string' => 'El campo :attribute debe contener al menos :min caracteres.',
		'array' => 'El campo :attribute debe contener al menos :min elementos.',
	],
	'not_in' => 'El campo :attribute seleccionado es inválido.',
	'not_regex' => 'El formato del campo :attribute es inválido.',
	'numeric' => 'El campo :attribute debe ser un número.',
	'password' => 'La contraseña es incorrecta.',
	'present' => 'El campo :attribute debe estar presente.',
	'regex' => 'El formato del campo :attribute es inválido.',
	'required' => 'El campo :attribute es obligatorio.',
	'required_if' => 'El campo :attribute es obligatorio cuando el campo :other es :value.',
	'required_unless' => 'El campo :attribute es requerido a menos que :other se encuentre en :values.',
	'required_with' => 'El campo :attribute es obligatorio cuando :values está presente.',
	'required_with_all' => 'El campo :attribute es obligatorio cuando :values están presentes.',
	'required_without' => 'El campo :attribute es obligatorio cuando :values no está presente.',
	'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de los campos :values están presentes.',
	'same' => 'Los campos :attribute y :other deben coincidir.',
	'size' => [
		'numeric' => 'El campo :attribute debe ser :size.',
		'file' => 'El archivo :attribute debe pesar :size kilobytes.',
		'string' => 'El campo :attribute debe contener :size caracteres.',
		'array' => 'El campo :attribute debe contener :size elementos.',
	],
	'starts_with' => 'El campo :attribute debe comenzar con uno de los siguientes valores: :values',
	'string' => 'El campo :attribute debe ser una cadena de caracteres.',
	'timezone' => 'El campo :attribute debe ser una zona horaria válida.',
	'unique' => 'El valor del campo :attribute ya está en uso.',
	'uploaded' => 'El campo :attribute no se pudo subir.',
	'url' => 'El formato del campo :attribute es inválido.',
	'uuid' => 'El campo :attribute debe ser un UUID válido.',

	/*
		    |--------------------------------------------------------------------------
		    | Custom Validation Language Lines
		    |--------------------------------------------------------------------------
		    |
		    | Here you may specify custom validation messages for attributes using the
		    | convention "attribute.rule" to name the lines. This makes it quick to
		    | specify a specific custom language line for a given attribute rule.
		    |
	*/

	'custom' => [
		'attribute-name' => [
			'rule-name' => 'custom-message',
		],
	],

	/*
		    |--------------------------------------------------------------------------
		    | Custom Validation Attributes
		    |--------------------------------------------------------------------------
		    |
		    | The following language lines are used to swap attribute place-holders
		    | with something more reader friendly such as E-Mail Address instead
		    | of "email". This simply helps us make messages a little cleaner.
		    |
	*/

	'attributes' => [
        'short_spanish' => "Español Corto",
        'short_english' => "Inglés Corto",
		'short' => 'Corto',
		// Companies
		'name' => 'Nombre',
		'max_stores' => 'Máximo Tiendas',
		'logo' => 'Logo',
		'image' => 'Imagen',
		'active' => 'Activo',
		'expire_at' => 'Vence el',
		'address' => 'Dirección',
		'country' => 'País',
		'phone' => 'Teléfono',
		'fax' => 'Fax',
		'email' => 'Correo Electrónico',
		'first_name' => 'Nombre',
		'middle_name' => 'Segundo Nombre',
		'last_name' => 'Paterno',
		'maternal_name' => 'Materno',
		'nationality' => 'Nacinalidad',
		'language_id' => 'Idioma',
		'website' => 'Website',
		'position_id' => 'Puesto',

// Servicios
		'image' => 'Imagen',
		'service' => 'Servicio',
		'short' => 'Corto',
		'charges' => 'Genera Cargos?',
		'next_route' => 'Siguiente Ruta',
		'route_transaction' => 'Ruta Transacción',
		'route_index' => 'Ruta Índice',
		'requiere_customer' => 'Requiere Cliente',
		'requiere_provider' => 'Requiere Proveedor',
		'requiere_receiver' => 'Requiere Receptor',
		'requiere_payer' => 'Requiere Pagador',
		'require_exchangerate' => 'Requiere Tipo de Cambio',
		'require_issue' => 'Require Empresa Emisora',
		'require_bank' => 'Require Banco',
		'select_file' => 'Elija Archivo (imagen)',
		'ctr_report' => 'Reportar CTR',
		'limit_ctr' => 'Limite CTR',
		'available_menu' => '¿Disponble en Menu?',
		'use_authorization' => 'Usa Autorización?',
// Claves de movimiento
		'key' => 'Clave',
		'type' => 'Tipo',
		'amount_type_id' => 'Importe',

// Bancos
		'bank' => 'Banco',
// Usuarios
		'role_id' => 'Rol',
		'company_id' => 'Empresa',

// Proveedores
		'provider' => 'Proveedor',
// Clientes
		'dob' => 'F. Nac',
		'city' => 'Ciudad',
		'state' => 'Estado',
		'zipcode' => 'Cod Pos',
		'ssn' => 'ssn',
		'ein' => 'ein',
		'itin' => 'itin',
		'occupation' => 'Ocupación',

// Generales
        'qty_ids'       => 'Identificaciones',
        'service_id'    => 'Servicio',
        'lower_limit'   => 'Desde',
        'upper_limit'   => 'Hasta',
        'fixed_fee'     => 'Cuota Fija',
        'percentage'            => 'Porcentaje',
// Tomado de la estructura de la base de datos
		'abilities'             => 'Habilidades',
		'action'                => 'Acción',
		'action_type'           => 'Tipo de Acción',
		'active'                => 'Activo',
		'address'               => 'Dirección',
		'adicional_ids'         => 'Ids Adicionales',
		'amount'                => 'Importe',
		'amount_bd_exchanges'   => 'Importe Cambio Cheques',
		'amount_bd_transfers'   => 'Importe Envíos de Dinero',
		'amount_before'         => 'Importe Antes',
		'amount_close'           => 'Importe Cerrar',
		'amount_commission'     => 'Importe Comisión',
		'amount_commission_before'=> 'Importe Comisión Antes',
		'amount_max_by_mo'      => 'Imp. Máximo x Money Order',
		'amount_max_to_lottery' => 'Imp. Máximo Pago Lotería',
		'amount_open'           => 'Importe Abrir',
		'amount_requiere_income'=> 'Importe Solicitar Comprobate Ingresos',
		'amount_require_adicional_id'    => 'Importe Solicitar Id Adicional',
		'amount_safe'           => 'Importe Caja Fuerte',
		'amount_subsidiaries'   => 'Importe Subsidiarias',
		'amount_to_notify'      => 'Importe para notificar',
		'amount_to_req_serial_mo'    => 'Importe solicitar No. Serie Money Order',
		'amount_to_require_id'    => 'Importe solicitar Id',
		'amount_transaction'    => 'Importe Transacción',
		'aproved'    => 'Aprobado',
		'areacode'    => 'Código de área',
		'authorization_code'    => 'Código Autorización',
		'authorization_id'    => 'Autorización',
		'authorizer_id'    => 'Autorizador',
		'available_menu'    => 'Disponible Menú?',
		'balance'    => 'Saldo',
		'balance_max_fri'    => 'Saldo Max Viernes',
		'balance_max_mon'    => 'Saldo Max Lunes',
		'balance_max_sat'    => 'Saldo Max Sábado',
		'balance_max_sun'    => 'Saldo Max Domingo',
		'balance_max_thu'    => 'Saldo Max Jueves',
		'balance_max_tue'    => 'Saldo Max Martes',
		'balance_max_wed'    => 'Saldo Max Miércoles',
		'balance_min_fri'    => 'Saldo Min Viernes',
		'balance_min_mon'    => 'Saldo Min Lunes',
		'balance_min_sat'    => 'Saldo Min Sábado',
		'balance_min_sun'    => 'Saldo Min Domingo',
		'balance_min_thu'    => 'Saldo Min Jueves',
		'balance_min_tue'    => 'Saldo Min Martes',
		'balance_min_wed'    => 'Saldo Min Miércoles',
		'bank'    => 'Banco',
		'bank_id'    => 'Banco',
		'batch'    => 'No. Migración',
		'birthday'    => 'Fecha Nacimiento',
		'black_list'    => 'Lista negra',
		'card'    => 'Tarjeta',
		'cashier_id'    => 'Cajero',
		'cashier_id_destination'    => 'Cajero Destino',
		'cashier_reports'    => 'Cajero Reporta',
		'cashier_responsible'    => 'Cajero Responsable',
		'ch_accept'    => 'Aceptar Cheque',
		'ch_change'    => 'Aceptar Cambio',
		'ch_receive'    => 'Aceptar Recibir',
		'ch_request'    => 'Aceptar Requerimiento',
		'charges'    => 'Cargos',
		'check_company_id'    => 'Empresa Cheque',
		'check_date'    => 'Fecha del Cheque',
		'check_number'    => 'No. De Cheque',
		'code'    => 'Código',
		'comission_amount'    => 'Importe Comisión',
		'comission_percentage'    => '% Comisión',
		'company'    => 'Empresa',
		'company_id'    => 'Empresa',
		'connection'    => 'Conexión',
		'copies'    => 'Copias',
		'copies_amount'    => 'Importe Copias',
		'copies_qty'    => 'Cantidad Copias',
		'copies_rate'    => 'Cuota Copias',
		'corporative'    => 'Corporativa',
		'country'    => 'País',
		'country_id'    => 'País',
		'county'    => 'Condado',
		'created_at'    => 'Creado(a)',
		'ctr_report'    => 'Reporte CTR',
		'current_team_id'    => 'Equipo Actual',
		'customer_id'    => 'Cliente',
		'date'    => 'Fecha',
		'days'    => 'Días',
		'days_check_to_authorization'    => 'Días antigüedad cheque para autorizar',
		'days_providers_exchanges'    => 'Días cambio de cheques en proveedores',
		'days_providers_transfers'    => 'Días Envíos de dinero en proveedores',
		'days_subsidiaries'    => 'Días Subsidiarias',
		'days_to_notify'    => 'Días para notificar',
		'days_to_require_id'    => 'Días para solicitar Id',
		'delete_process_id'    => 'Id Proceso para Borrar',
		'deleted_at'    => 'Borrado el',
		'denomination_id'    => 'Id Denominación',
		'description'    => 'Descripción',
		'detail_denominations'    => 'Detalle denominaciones',
		'discount_percentage'    => '% Descuento',
		'email'    => 'Correo Electrónico',
		'email_verified_at'    => 'Correo Electrónico Verficiado el',
		'english'    => 'Inglés',
		'entity'    => 'Entidad',
		'exception'    => 'Excepción',
		'exchange_rate'    => 'Tipo de Cambio',
		'expire_at'    => 'Expira el',
		'failed_at'    => 'Fallo',
		'fax_international_extra'    => 'Costo Fax Int Hoja Extra',
		'fax_international_first'    => 'Costo Fax Int Primer Hoja',
		'fax_national_extra'    => 'Costo Fax Nac Hoja Extra',
		'fax_national_first'    => 'Costo Fax Nac Primer Hoja',
		'fee_by_country'    => 'Cuota x País',
		'fee_by_latinoamerica'    => 'Cuota x Latinoamérica',
		'first_name'    => 'Nombre',
		'first_time_exceds'    => 'Primer vez que excede',
		'first_time_exchanges'    => 'Primer vez excede en Cheques',
		'first_time_transfers'    => 'Primer vez excede en Envíos',
		'fixed_fee'    => 'Cuota fija',
		'folio'    => 'Folio',
		'folio_petty'    => 'Folio Retiro Petty',
		'folio_safes'    => 'Folio Caja Fuerte',
		'folio_transfers'    => 'Folio Envíos',
		'full_access'    => 'Acceso Total',
		'id'    => 'Id',
		'identification_id'    => 'Identificación',
		'image'    => 'Imagen',
		'include'    => 'Incluir?',
		'input'    => 'Entrada',
		'international'    => 'Internacional',
		'international_fax_amount'    => 'Importe Fax Internacional',
		'international_fax_qty'    => 'Cantidad Fax Internacional',
		'ip_address'    => 'Dirección IP',
		'isdefault'    => '¿Predeterminado?',
		'item'    => 'Entrada',
		'key_mov'    => 'Clave Movimiento',
		'key_movement_id'    => 'Clave Movimiento',
		'keyable_id'    => 'Id Asociado',
		'keyable_type'    => 'Modelo Asociado',
		'last_activity'    => 'Última actividad',
		'last_name'    => 'Apellido',
		'last_used_at'    => 'Usado última vez',
		'latinoamerica'    => 'Latinoamérica',
		'latitude'    => 'Latitud',
		'limit_allowed'    => 'Límite Permitido',
		'limit_by_day_exchanges'    => 'Limite x día para Cheques',
		'limit_by_day_transfers'    => 'Límite x día para Envíos',
		'limit_ctr'    => 'Límite para CTR',
		'lock_customer'    => '¿Cliente Bloqueado?',
		'locked'    => '¿Bloqueado?',
		'logo'    => 'Logotipo',
		'longitude'    => 'Longitud',
		'low_percentage'    => '% Mínimo',
		'lower_limit'    => 'Desde',
		'mark_id'    => 'Marcar',
		'markable_id'    => 'Id Asociado',
		'markable_type'    => 'Modelo Asociado',
		'marked'    => 'Marcar',
		'maternal_name'    => 'Materno',
		'max_subidiaries'    => 'Sucursales Permitidas',
		'message'    => 'Mensaje',
		'middle_name'    => 'Segundo Nombre',
		'migration'    => 'Migración',
		'movement_id'    => 'Movimiento',
		'name'    => 'Nombre',
		'name_notify'    => 'Nombre a quien notificar',
		'national_fax_amount'    => 'Importe fax Nacional',
		'national_fax_qty'    => 'Cantidad fax Nacional',
		'next_route'    => 'Siguiente ruta',
		'notes'    => 'Notas',
		'occupation_id'    => 'Ocupación',
		'open'    => 'Abierto',
		'open_close_extra'    => 'Abrir/Cerrar Extra',
		'opening_id'    => 'Apertura',
		'owner'    => 'Propietario',
		'password'    => 'Contraseña',
		'payer'    => 'Pagador',
		'payer_id'    => 'Pagador',
		'payload'    => 'Carga',
		'percentage'    => 'Porcentaje',
		'percentage_before'    => '% Antes',
		'percentage_transaction'    => '% Transacción',
		'permission_id'    => 'Permiso',
		'phone'    => 'Teléfono',
		'photo'    => 'Foto',
		'policy'    => 'Política',
		'priority'    => 'Prioridad',
		'process_close'    => 'Proceso Cerrar Caja',
		'process_open'    => 'Proceso Abrir Caja',
		'profile_photo_path'    => 'Ruta foto perfil',
		'provider'    => 'Proveedor',
		'provider_id'    => 'Proveedor',
		'providers_exchanges'    => 'Proveedores Cheques',
		'providers_transfers'    => 'Proveedores Envíos',
		'qty_by_wad'    => 'Cantidad x Fajo',
		'quantity'    => 'Cantidad',
		'queue'    => 'Fila',
		'reason'    => 'Causa',
		'reason_id'    => 'Causa',
		'receive_process_id'    => 'Proceso Recibir',
		'received_date'    => 'Fecha Recibido',
		'receiver_id'    => 'Receptor',
		'recharge_type_id'    => 'Tipo de Recarga',
		'reference'    => 'Referencia',
		'region'    => 'Región',
		'register'    => 'Caja Registradora',
		'register_id'    => 'Caja',
		'register_id_destination'    => 'Caja Destino',
		'registers_allowed'    => 'Cajas Permitidas',
		'remember_token'    => 'Token Recordatorio',
		'require_bank'    => '¿Requiere Banco?',
		'require_customer'    => '¿Requiere Cliente?',
		'require_exchangerate'    => '¿Requiere Tipo Cambio?',
		'require_issue'    => '¿Requiere Empresa Cheque?',
		'require_payer'    => '¿Requiere Pagador?',
		'require_provider'    => '¿Require Proveedor?',
		'require_receiver'    => '¿Requiere Receptor?',
		'role_id'    => 'Rol',
		'route'    => 'Ruta',
		'route_index'    => 'Ruta índice',
		'route_transaction'    => 'Ruta Transacción',
		'send_process_id'    => 'Proceso Enviar',
		'serial_number'    => 'No. Serie',
		'service_id'    => 'Servicio',
		'service_id_difference'    => 'Servicio Diferencia',
		'short'    => 'Corto',
		'short_english'    => 'Inglés Corto',
		'short_spanish'    => 'Español Corto',
		'slug'    => 'Slug',
		'spanish'    => 'Español',
		'spanish_description'    => 'Descripción Español',
		'spanish_image'    => 'Imagen Español',
		'spanish_message'    => 'Mensaje Español',
		'spanish_policy'    => 'Política en Español',
		'state'    => 'Estado',
		'status_id'    => 'Estado',
		'subsidiary'    => 'Sucursal',
		'subsidiary_id'    => 'Sucursal',
		'subsidiary_id_destination'    => 'Sucursal Destino',
		'surplus'    => 'Ganancia',
		'times_subsidiares'    => 'Cuantas Subsidiarias',
		'timezone'    => 'Zona Horaria',
		'token'    => 'Token',
		'tokenable_id'    => 'Id Asociado',
		'tokenable_type'    => 'Modelo Asociado',
		'total_charges'    => 'Total Cargos',
		'town'    => 'Población',
		'transaction_id'    => 'Transacción',
		'transactiontable_id'    => 'Id Asociado',
		'transactiontable_type'    => 'Modelo Asociado',
		'two_factor_recovery_codes'    => 'Doble factor recuperar código',
		'two_factor_secret'    => 'Doble factor secreto',
		'type'    => 'Tipo',
		'type_amount'    => 'Tipo Importe',
		'type_movement'    => 'Tipo Movimiento',
		'type_transference_id'    => 'Tipo Transferencia',
		'types_payment_id'    => 'Tipo Pago',
		'types_payout_id'    => 'Tipo Pago',
		'unmarked_mark_id'    => 'Desmarcar',
		'unmarked_user_at'    => 'Desmarcado el',
		'unmarked_user_id'    => 'Desmarcado por',
		'updated_at'    => 'Actualizado el',
		'url'    => 'URL',
		'use_authorization'    => '¿Usa autorización?',
		'use_policies'    => '¿Usa políticas?',
		'use_register'    => '¿Usa caja?',
		'use_to_mark'    => '¿Para desmarcar?',
		'user_agent'    => 'Agente',
		'user_id'    => 'Usuario',
		'uuid'    => 'UUID',
		'value'    => 'Valor',
		'value_to_count'    => 'Valor a Contar',
		'value_type'    => 'Tipo de Valor',
		'vip_id'    => 'Vip',
		'zipcode'    => 'Código Postal',

	]

];
