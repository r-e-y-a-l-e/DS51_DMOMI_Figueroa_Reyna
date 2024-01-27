import 'package:flutter/material.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key, required this.title});

  final String title;

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {

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
            Padding(padding: EdgeInsets.all(50), child: Image(image: AssetImage('muffin.jpg')),),
            Text('Reyna Figueroa', style: TextStyle(fontWeight: FontWeight.bold)),
            SizedBox(height: 20),
            Center( child:
            Row( mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Column(children: [Text('19'), Text('Edad', style: TextStyle(fontWeight: FontWeight.bold))]),
              SizedBox(width: 20),
              Column(children: [Text('01/07'), Text('FdN', style: TextStyle(fontWeight: FontWeight.bold))]),
              SizedBox(width: 20),
              Column(children: [Text('MEX'), Text('NAC', style: TextStyle(fontWeight: FontWeight.bold))]),
            ]),
            ),
            SizedBox(height: 20),
            Row(mainAxisAlignment: MainAxisAlignment.center,
            children: [
              ElevatedButton(onPressed: null, child: Text('Ver +')),
              SizedBox(width: 20),
              ElevatedButton(onPressed: null, child: Text('Links')),
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