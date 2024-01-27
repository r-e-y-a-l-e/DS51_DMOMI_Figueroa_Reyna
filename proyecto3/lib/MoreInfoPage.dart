import 'package:flutter/material.dart';

class MoreInfoPage extends StatefulWidget {
  const MoreInfoPage({super.key, required this.title});

  final String title;

  @override
  State<MoreInfoPage> createState() => _MoreInfoPageState();
}

class _MoreInfoPageState extends State<MoreInfoPage> {

  @override
  Widget build(BuildContext context) {
  return Scaffold(
    appBar: AppBar(
      backgroundColor: Theme.of(context).colorScheme.inversePrimary,
      title: Text(widget.title),
    ),
    body: const Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: <Widget>[
            Text('Reyna Figueroa', style: TextStyle(fontWeight: FontWeight.bold)),
            SizedBox(height: 20),
            Center( child:
            Row( mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Column(children: [Text('Direccion',style: TextStyle(fontWeight: FontWeight.bold)), Text('Evangelina Paredes #43')]),
              SizedBox(width: 25),
              Column(children: [Text('Telefono', style: TextStyle(fontWeight: FontWeight.bold)), Text('6623957856')]),
            ]),
            ),
            SizedBox(height: 20),
            Row(mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Column(children: [Text('CURP', style: TextStyle(fontWeight: FontWeight.bold)), Text('FIGR040701MSRGNYA6')]),
              SizedBox(width: 20),
              Column(children: [Text('Contacto Emergencia', style: TextStyle(fontWeight: FontWeight.bold)), Text('6623396678')]),
            ]),
            SizedBox(height: 20),
            Row(mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Column(children: [Text('Tipo de Sangre', style: TextStyle(fontWeight: FontWeight.bold)), Text('O+')]),
              SizedBox(width: 20),
              Column(children: [Text('Contacto Alergias', style: TextStyle(fontWeight: FontWeight.bold)), Text('Ninguna')]),
            ]),
            SizedBox(height: 20),
            Row(mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Column(children: [Text('Altura', style: TextStyle(fontWeight: FontWeight.bold)), Text('1.65m')]),
              SizedBox(width: 20),
              Column(children: [Text('Peso', style: TextStyle(fontWeight: FontWeight.bold)), Text('50 Kg')]),
            ]),
          ]
        ),
      ),
      floatingActionButton: const FloatingActionButton(
        onPressed: null,
        tooltip: 'Check',
        child: Icon(Icons.check),
      ),
    );
}
}