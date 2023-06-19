import 'package:flutter/material.dart';

import 'screens/home_page.dart';

void main() => runApp(const MiniPressApp());

class MiniPressApp extends StatelessWidget {
  const MiniPressApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'MiniPress',
      debugShowCheckedModeBanner: false,
      theme: ThemeData(
        primarySwatch: Colors.blue,
      ),
      home: const HomePage(),
    );
  }
}
