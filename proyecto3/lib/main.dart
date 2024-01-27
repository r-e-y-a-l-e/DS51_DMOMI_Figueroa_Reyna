import 'package:flutter/material.dart';
import 'package:proyecto3/HomePage.dart';
import 'package:proyecto3/MoreInfoPage.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Identificacion',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: const Color.fromARGB(255, 78, 1, 28)),
        useMaterial3: true,
      ),
      home: const HomePage(title: 'Identificacion'),
    );
  }
}

