<!--
    **Project: SERVICIOS FINANCIEROS
    **Case of use: MODULO GARANTIAS
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to warranty terms and conditions
    **Date: 6/03/2019
     -->
@extends('layouts.BasicIncludes')
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-781153823"></script>
<script>
    window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','AW-781153823',{'page_title':'Términos y condiocines, garantías','page_path':'/digitalWarranty/TermsConditions'});
</script>
@section('content')

<div>
    <div class="align-self-center ml-auto ">
        <a href="{{ route('warranty') }}" class="align-middle warrantyBack-xs">Regresar</a>
    </div>
    <div class="row resetRow TermsHeader">
        <div class="logoHeaderTerms">
            <a href="{{ url()->previous() }}"> <img src="{{ asset('images/warranty-oportunidades.png') }}"
                    class="img-fluid" alt="Oportuya" /> </a>
        </div>
        <div class="align-self-center ml-auto conditions">
            <a href="{{  route('warranty') }}" class="align-middle warrantyLegal">Regresar</a>
        </div>
    </div>
    <h1 class="titleTerms text-center">RECOMENDACIONES GENERALES</h1>
    <div class="container">
        <p class="menuItem-text" align="justify">
            Estimado cliente; con el fin de prestarle un adecuado servicio posventa, a la medida de sus necesidades como
            cliente preferencial para nuestra compañía, nos permitimos brindarle las siguientes recomendaciones para el
            uso e instalación de los productos comprados en nuestros establecimientos de comercio y/o página web, las
            cuales permitirán que disfrute su artículo al máximo, garantizando su cuidado, rendimiento y durabilidad.
        </p>
        <p class="menuItem-text" align="justify">
            • Exija la revisión física, detalle el estado y revise el funcionamiento de su producto y accesorios cuando
            le realicen la entrega.
        </p>
        <p class="menuItem-text" align="justify">
            • Si la compra fue realizada por la página web, revise su artículo y el funcionamiento del mismo en el
            momento de la entrega, ya que cuenta sólo con 24 horas después de recibido para realizar una reclamación por
            estado físico.
        </p>
        <p class="menuItem-text" align="justify">
            • Verifique y siga las recomendaciones de instalación, uso (doméstico o comercial) y mantenimiento indicadas
            en el manual del producto.
        </p>
        <p class="menuItem-text" align="justify">
            • Consulte con el asesor el término de la garantía con el que cuenta el producto y el tiempo adicional que
            se da para determinados componentes.
        </p>
        <p class="menuItem-text" align="justify">
            • En caso de presentarse algún problema, acérquese directamente al almacén para el registro, seguimiento y
            control del proceso de garantía, con el fin de que no sufra inconvenientes de retrasos con el fabricante. Si
            la compra se realizó por la página web, comuníquese a la línea 018000117787 y/o (6) 3358557 en la ciudad de
            Pereira.
        </p>
        <p class="menuItem-text" align="justify">
            • Los productos que apliquen para garantía se recogen en el mismo sitio donde se entregaron cuando se
            realizó la venta y se devolverá allí mismo.
            <b>Nota</b>: posterior a la entrega, los accesorios no cuentan con garantía, ya que dependen del cuidado y
            uso del consumidor.

        </p>
        <p class="menuItem-text" align="justify">
            • Para la instalación de productos (lavadoras, aires acondicionados, nevecones y estufas), se debe comunicar
            con el fabricante a los números de atención, de acuerdo a la marca (horario y costo dependen del
            fabricante).
        </p>
        <p class="menuItem-text" align="justify">

        </p>
        <p class="menuItem-text" align="justify">
            • Exija la entrega de su factura al comprar un artículo y el recibo cuando pague sus cuotas.
        </p>
        <p class="menuItem-text" align="justify">
            • Exija la entrega de su factura al comprar un artículo y el recibo cuando pague sus cuotas.
        </p>
        <p class="menuItem-text" align="justify">
            • Infórmese sobre los términos y condiciones del crédito, en especial sobre los valores a cancelar, fechas
            de pago y los servicios que están incluidos o son suplementarios en la cuota, tales como: garantía
            suplementaria, seguros, cuotas de manejo, entre otros, según corresponda, y lo cual varía de acuerdo a la
            línea de crédito utilizada.
        </p>
        <p class="menuItem-text" align="justify">
            • Infórmese y pregunte por las promociones y campañas vigentes.
        </p>
        <p class="menuItem-text" align="justify">
            • Infórmese sobre los beneficios y valores agregados que le brinda la compañía al comprar determinadas
            líneas de crédito.
        </p>
    </div>
    <h1 class="titleTerms text-center">TÉRMINOS Y CONDICIONES GARANTÍA LEGAL</h1>
    <div class="container">
        <p class="menuItem-text" align="justify">
            El artículo 7 de la ley 1480 del 2011 indica que la “garantía legal es una obligación que tiene todo
            productor o proveedor para responder por la calidad y buen funcionamiento de los productos que ha puesto
            a la venta para los consumidores”. El artículo 8 de la ley 1480 del 2011 determina que el “término de la
            garantía legal será el dispuesto por la ley o por la autoridad competente, a falta de disposición de
            obligatorio cumplimiento, será el enunciado por el productor y/o proveedor”. Señor usuario este servicio
            lo presta el fabricante siempre y cuando este dentro del término vigente de la garantía legal, verifique
            su manual de funciones y/o factura, para mayor información se puede comunicar
            a los números: 01 8000 117 787 o (6) 33 58 557 en Pereira.
        </p>
    </div>
    <h1 class="titleTerms text-center">TÉRMINOS Y CONDICIONES GARANTÍA SUPLEMENTARIA</h1>
    <div class="container">
        <p class="menuItem-text" align="justify">
            El artículo 13 de la ley 1480 del 2011 denomina la “Garantía Suplementaria como la ampliación
            del término legal de la garantía o el mejoramiento de esta, la garantía suplementaria puede otorgarse
            de manera gratuita o de manera onerosa, el consumidor debe pagar un porcentaje adicional al precio
            de la cosa adquirida y además es necesario que este acepte de manera expresa pagar el costo”
            Señor usuario este servicio lo presta la aseguradora siempre y cuando usted haya adquirido la
            garantía suplementaria, por favor verifique sus facturas, para mayor información se puede comunicar
            a los números: 01 8000 117 787 o (6) 33 58 557 en Pereira.
        </p>
    </div>

    <div class="container">
        <h1 class="titleTerms text-center">POLÍTICA RETRACTO </h1>
        <p class="menuItem-text" align="justify">
            Estimado cliente, tenga presente que podrá desistir de su compra haciendo uso de la figura del retracto a
            que tiene derecho según la ley 1480 de 2011 en compras mediante sistemas de financiación y métodos no
            tradicionales;
        </p>
        <h1 class="titleTerms text-center">Política de retracto para ventas mediante sistemas de financiación y métodos
            no tradicionales. </h1>
        <p class="menuItem-text" align="justify">
            Para ventas mediante sistemas de financiación directa o utilizando métodos no tradicionales o a distancia,
            de acuerdo a lo establecido en el estatuto del consumidor (Ley 1480 de 2011, cap. 5 art. 47 y 48), usted
            puede ejercer su derecho al retracto, en un término máximo de cinco (5) días hábiles, contados a partir de
            la entrega del bien o de la celebración del contrato bajo las siguientes condiciones, así:
        </p>
        <p class="menuItem-text" align="justify">
            • Si el producto fue entregado en el establecimiento de comercio, deberá ser devuelto en este mismo lugar.
        </p>
        <p class="menuItem-text" align="justify">
            • Si el producto fue entregado en el domicilio del comprador, éste podrá ser recogido en el mismo lugar de
            entrega, teniendo presente que deberá asumir los gastos de transporte y devolución que se generen.
        </p>
        <p class="menuItem-text" align="justify">
            • El producto deberá estar completo, en su empaque original, no puede presentar uso, no puede tener rayones,
            hundimientos y/o parches que deterioren su perfil estético y debe contener controles, manuales y demás
            aditamentos y accesorios necesarios para el funcionamiento del electrodoméstico adquirido.
        </p>
        <p class="menuItem-text" align="justify">
            • En caso de inquietudes usted podrá comunicarse a la línea 018000117787 o (6) 3358557 en Pereira, también
            podrá escribir al correo electrónico servicioalcliente@lagobo.com
        </p>
        <p class="menuItem-text" align="justify">
            <b>Nota</b>: “las ventas mediante sistemas de financiación y métodos no tradicionales”, se traducen a todas
            las compras que usted realiza por cualquier medio y/o a crédito exceptuando las compras de contado
            presencial.
        </p>
        <p class="menuItem-text" align="justify">
            <b>Lo anterior dando cumplimiento a lo establecido en el Estatuto del Consumidor </b>, LAGOBO, con el fin de
            dar estricto cumplimiento a los mandatos normativos en materia del derecho al retracto, se permite ampliar
            la información, tema que es importante que usted como cliente conozca.
        </p>
        <p class="menuItem-text" align="justify">
            “[…] Artículo 47. Retracto. En todos los contratos para la venta de bienes y prestación de servicios
            mediante sistemas de financiación otorgada por el productor o proveedor, venta de tiempos compartidos o
            ventas que utilizan métodos no tradicionales o a distancia, que por su naturaleza no deban consumirse o no
            hayan comenzado a ejecutarse antes de cinco (5) días, se entenderá pactado el derecho de retracto por parte
            del consumidor. En el evento en que se haga uso de la facultad de retracto, se resolverá el contrato y se
            deberá reintegrar el dinero que el consumidor hubiese pagado como precio correspondiente al bien adquirido.
        </p>
        <p class="menuItem-text" align="justify">
            El consumidor deberá devolver el producto al productor o proveedor por los mismos medios y en las mismas
            condiciones en que lo recibió. Los costos de transporte y los demás que conlleve la devolución del bien
            serán cubiertos por el consumidor. El término máximo para ejercer el derecho de retracto será de cinco (5)
            días hábiles contados a partir de la entrega del bien o de la celebración del contrato en caso de la
            prestación de servicios.

        </p>
        <p class="menuItem-text" align="justify">
            El proveedor deberá devolverle en dinero al consumidor todas las sumas pagadas sin que proceda a hacer
            descuentos o retenciones por concepto alguno. En todo caso la devolución del dinero al consumidor no podrá
            exceder de treinta (30) días calendario desde el momento en que ejerció el derecho [...]”.
        </p>
        <p class="menuItem-text" align="right">
            <u>Fuente: Ley 1480 de 2011</u>
        </p>
        <h1 class="titleTerms text-center"> Política de cambio de producto para ventas de contado.</h1>

        <p class="menuItem-text" align="justify">
            Para ventas de contado no se pronuncia ley alguna de retracto que coaccione a realizar el cambio de producto
            o devolución de dinero, (excepto garantía). Tenga presente que LAGOBO realizará el cambio del producto, si
            usted lo considera necesario, por uso exclusivo de servicio, teniendo presente que su satisfacción como
            usuario prevalece, para lo cual si requiere del cambio y lo solicita dentro de los cinco (5) días siguientes
            a su adquisición, el producto deberá estar completo, en su empaque original, no puede presentar uso, no
            puede tener rayones, hundimientos y/o parches que deterioren su perfil estético y debe contener controles,
            manuales y demás aditamentos y accesorios necesarios para el funcionamiento del artículo adquirido. Es
            importante tener presente que el cambio del producto no implica devolución de dinero.
        </p>
        <p class="menuItem-text" align="justify">
            • Si el producto fue entregado en el establecimiento de comercio, deberá ser devuelto en este mismo lugar.
        </p>
        <p class="menuItem-text" align="justify">
            • Si el producto fue entregado en el domicilio del comprador, éste podrá ser recogido en el mismo lugar de
            entrega, teniendo presente que deberá asumir los gastos de transporte y devolución que se generen.
        </p>
        <h1 class="titleTerms text-center"> POLÍTICA DE GARANTÍAS</h1>
        <p class="menuItem-text" align="justify">
            Nuestra política de garantías, se encuentra enmarcada por lo establecido en la Ley 1480 del 2011 y el
            Decreto 1074 de 2015, en la que todos los productos comercializados y distribuidos tienen la garantía y el
            respaldo no sólo de los fabricantes o proveedores sino también de la compañía, en calidad de distribuidores
            y comercializadores, ya que nuestro ideal fundamental es apropiarnos del trámite, facilitando el proceso a
            nuestros clientes, intermediando como facilitadores frente a los fabricantes para lograr la satisfacción del
            cliente e incentivar la recompra.
        </p>
        <h1 class="titleTerms text-center">Política interna de cambio por garantía para ventas presenciales (crédito y
            contado).</h1>
        <p class="menuItem-text" align="justify">
            La política interna de cambio la aplica LAGOBO sólo por uso exclusivo de servicio, ya que en la actualidad
            no se presenta reglamentación alguna que apremie al distribuidor o comercializador a realizar el cambio de
            producto por la primer falla de funcionamiento del artículo, por eso LAGOBO realizará el cambio del producto
            siempre y cuando se cumpla con los siguientes postulados:
        </p>
        <p class="menuItem-text" align="justify">
            • Si la falla que presenta es por fabricación (no estética), y esta impide el funcionamiento del producto y
            se genera dentro de los primeros treinta (30) días calendario a partir de la entrega del bien, se procede
            con la reposición del artículo; siempre y cuando se encuentre en óptimas condiciones físicas, sin golpes,
            rayones, en su caja original con todos los accesorios, la instalación se haya realizado por personal
            autorizado por el fabricante (si aplica). Para la reposición, LAGOBO DISTRIBUCIONES S.A.S cuenta con diez
            (10) días hábiles siguientes al momento en que el consumidor ponga a disposición del productor o expendedor
            el bien objeto de la solicitud de efectividad de la garantía legal.
        </p>
        <p class="menuItem-text" align="justify">
            • La política aplica exclusivamente para cambio de producto, no implica devolución de dinero.
        </p>
        <p class="menuItem-text" align="justify">
            • Si el cambio es por un producto de la misma referencia se sostiene el precio inicial, si el cambio es por
            un producto de diferente referencia el cliente debe asumir el precio de la lista actual. <b>Nota</b>: El
            producto se repondrá siempre y cuando el daño que presente no sea por fuerza mayor o caso fortuito, causal
            que determina el centro de servicio autorizado de cada una de las marcas. Tenga presente que el artículo
            primero debe ingresar por revisión de un técnico especializado, quien indicará si el producto realmente
            tiene impedimento para funcionar por fallas de fabricación.
        </p>
        <h1 class="titleTerms text-center"> Excepciones: </h1>
        <p class="menuItem-text" align="justify">
            • Los colchones por tema de higiene no aplican en la política interna de cambio.
        </p>
        <p class="menuItem-text" align="justify">
            • Neveras con falla “no congela”. Inicialmente el producto debe ser revisado por un centro de servicio
            autorizado por la marca, con el fin de descartar una carga de gas, ya que este servicio es básico y no
            requiere de largo tiempo, ni repuestos.
        </p>
        <p class="menuItem-text" align="justify">
            • Productos con falla “no enciende”. Primero el producto debe ser revisado por un centro de servicio
            autorizado por la marca, con el fin de descartar un daño causado, después de obtener el diagnóstico de la
            falla se procede a realizar cambio de producto.
        </p>
        <p class="menuItem-text" align="justify">
            Si la falla se presenta después de los treinta (30) días calendario a la entrega del bien, se procede con la
            validación del producto mediante el centro del servicio autorizado de cada una de las marcas, quienes se
            encargarán de determinar si aplica reparación o reposición. Tenga en cuenta el siguiente procedimiento.
        </p>
        <h1 class="titleTerms text-center"> <u> “DE TU GARANTÍA ME ENCARGO YO” </u> </h1>
        <h1 class="titleTerms "> Procedimiento para garantía legal </h1>
        <p class="menuItem-text" align="justify">
            Señor usuario, por favor tener presente los siguientes pasos al momento de requerir la gestión de su
            garantía:
        </p>
        <p class="menuItem-text" align="justify">
            • Si la compra fue presencial, usted debe ir al almacén y solicitar la garantía, en caso de haber realizado
            la compra por la página web, debe comunicarse a la línea 018000117787 y/o (6) 3358557 en la ciudad de
            Pereira.
        </p>
        <p class="menuItem-text" align="justify">
            • El director de la sucursal o el Departamento de Garantías realizará el trámite de la garantía, de acuerdo
            al procedimiento que exija el fabricante.
        </p>
        <p class="menuItem-text" align="justify">
            • Solicite el formato de recibido (en caso de dejar el producto en el almacén) o de reclamación (en caso de
            no entregar el producto). Si la reclamación es vía telefónica, reclame el número de caso correspondiente a
            su servicio.
        </p>
        <p class="menuItem-text" align="justify">
            • Se programa la prestación del servicio en caso de requerirse en su lugar de residencia. Si por el
            contrario usted debe llevar el artículo hasta nuestra sucursal, el director del almacén se comunicará con
            usted para informarle cuando el servicio se haya prestado y pueda recepcionar el artículo nuevamente. El
            plazo para la reparación del bien es de treinta (30) días hábiles siguientes, contados a partir del día
            siguiente a la entrega del bien para la reparación. En los casos en los que el productor o proveedor
            dispongan de un bien en préstamo para el consumidor mientras se efectúa la reparación del mismo, el término
            para la reparación podrá extenderse hasta por sesenta (60) días hábiles.
        </p>
        <p class="menuItem-text" align="justify">
            • Actuamos bajo el Decreto 0735 de 2013, Artículo 2. el cual establece que para solicitar la efectividad de
            la garantía, el consumidor deberá dejar el producto en el mismo sitio donde se lo entregaron cuando lo
            compró, a disposición del proveedor para la gestión de la garantía y tiene derecho a que se lo devuelvan
            allí mismo.
        </p>
        <p class="menuItem-text" align="justify">
            • En caso de tener algún inconveniente con su garantía o demora en el servicio se puede comunicar a la línea
            telefónica 018000117787 y/o (6) 3358557 en la ciudad de Pereira.
        </p>
        <p class="menuItem-text" align="justify">
            • Si es de su preferencia también puede solicitar y tramitar su servicio de garantía por la plataforma
            “Garantia Digital” que se encuentra ubicada en la página <a
                href="http://www.serviciosoportunidades.com">www.serviciosoportunidades.com</a> , sin importar su medio
            de compra (presencial o virtual), por este medio lo atenderá asesores especializados en garantía de los
            almacenes Oportunidades.
        </p>
        <p class="menuItem-text" align="justify">
            Tenga en cuenta:
        </p>
        <p class="menuItem-text" align="justify">
            • Los accesorios no tienen garantía.
        </p>
        <p class="menuItem-text" align="justify">
            • Debe conservar en perfecto estado, sin alteración alguna el ticket del serial de los productos (son las
            etiquetas que están adheridas en la parte trasera o lateral del artículo) de no tenerlo o presentar
            deterioro que no permita su visibilidad, no es procedente la garantía.
        </p>
        <p class="menuItem-text" align="justify">
            • No se responde por accesorios faltantes una vez recibido el producto a satisfacción.
        </p>
        <p class="menuItem-text" align="justify">
            • Debe cumplir con los cuidados, advertencias y uso descritos en el manual de instrucciones.
        </p>
        <p class="menuItem-text" align="justify">
            • El plazo máximo inicial estipulado por la ley para la reparación del bien es de treinta (30) días hábiles
            siguientes, contados a partir del día siguiente a la entrega del bien para la reparación.
        </p>
        <p class="menuItem-text" align="justify">
            • El periodo de garantía será suspendido durante la vigencia de la revisión del producto y se reanudará una
            vez éste es entregado al consumidor. Para productos donde haya operado la reposición, la garantía inicia
            desde cero una vez entregado el nuevo producto.
        </p>
        <p class="menuItem-text" align="justify">
            • En el caso de las compras a crédito, tenga presente que si el artículo se encuentra en estado de garantía
            o está pendiente por el servicio, usted debe continuar pagando las cuotas de su crédito y nuestra
            responsabilidad es darle trámite a la garantía del producto para que así no se vea afectado su historial
            crediticio.
        </p>
        <h1 class="titleTerms "> EXONERACIÓN DE LA GARANTÍA: Art.16. Ley 1480/2011 </h1>
        <p class="menuItem-text" align="justify">
            • Vencimiento de los términos de su vigencia.
        </p>
        <p class="menuItem-text" align="justify">
            • Fuerza mayor o caso fortuito.
        </p>
        <p class="menuItem-text" align="justify">
            • El hecho de un tercero que causa el defecto.
        </p>
        <p class="menuItem-text" align="justify">
            • Manipulación de personal no autorizado.
        </p>
        <p class="menuItem-text" align="justify">
            • El uso indebido del bien por parte del consumidor.
        </p>
        <p class="menuItem-text" align="justify">
            • El consumidor no atendió las instrucciones de instalación, uso o mantenimiento indicadas en el manual del
            producto.
        </p>
        <h1 class="titleTerms "> 1. ATENCIÓN A PQR´S </h1>
        <p class="menuItem-text" align="justify">
            Estimado cliente, LAGOBO cuenta con la política de Peticiones, Quejas, Reclamos y Sugerencias (PQR´S),
            cuando lo considere necesario puede notificar a la compañía cualquier inconformidad o sugerencia, mediante
            el correo electrónico <u>notificaciones@lagobo.com</u>. <br> Para realizar el trámite de forma presencial,
            usted debe:
        </p>
        <p class="menuItem-text" align="justify">
            • Diligenciar el formato de PQR’s que se encuentra disponible en todas la sucursales a nivel nacional.
        </p>
        <p class="menuItem-text" align="justify">
            • Diligenciar todos los campos, en especial los datos de identificación, contacto y la descripción de su
            PQR´S. Recuerde que mientras más claro sea con sus ideas, más efectiva será la respuesta que brinde la
            compañía.
        </p>
        <p class="menuItem-text" align="justify">
            • Una vez diligenciado el formato PQR´S, debe ser entregado a la cajera, y solicitar copia del recibido.
            Posteriormente se enviará el formato al Departamento Jurídico donde se realizará la debida gestión para su
            oportuna respuesta dentro de los quince (15) días hábiles establecidos por la ley, prorrogables hasta por el
            mismo término inicial en caso de no contar con una respuesta clara y verificable por parte del fabricante o
            nuestra compañía.
        </p>
        <p class="menuItem-text" align="justify">
            • Si es de su preferencia o necesidad puede llevar diligenciado otro formato o documento, que contenga las
            especificaciones ya mencionadas.
        </p>
        <p class="menuItem-text" align="justify">
            • Si es de su preferencia o necesidad puede llevar diligenciado otro formato o documento, que contenga las
            especificaciones ya mencionadas.
        </p>
        <p class="menuItem-text" align="justify">
            Los medios definidos por LAGOBO para la atención de PQRS son:
        </p>
        <p class="menuItem-text" align="justify">
            Página web: <a href="http://www.oportunidades.com.co"> <u>www.oportunidades.com.co</u></a> <br>
            Línea gratuita nacional: 018000117787 <br>
            Correo electrónico: <u> notificaciones@lagobo.com</u> <br>
            Línea telefónica: (6) 3358557 de la ciudad de Pereira. <br>
            Directamente en cada establecimiento de comercio <b> ALMACENES OPORTUNIDADES Y/O ELECTROFERTAS. </b> <br>

        </p>
        <p class="menuItem-text" align="center">
            LAGOBO se reserva el derecho de hacer ajuste o modificaciones a su política de atención de garantías, la
            cual una vez realizada, será notificada en los establecimientos de comercio y/o páginas web.
        </p>
    </div>
</div>
@stop