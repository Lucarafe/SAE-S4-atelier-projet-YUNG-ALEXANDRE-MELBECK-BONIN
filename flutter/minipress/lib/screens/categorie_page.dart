import 'package:flutter/material.dart';

import '../models/categorie.dart';

class CategoriePage extends StatelessWidget {
  final Categorie categorie;

  const CategoriePage({Key? key, required this.categorie}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(categorie.titre),
      ),
      body: Container(
        padding: EdgeInsets.all(16.0),
        child: Center(
          child: Text(
            'Liste des articles par la catégorie : ${categorie.titre}',
            style: TextStyle(
              fontSize: 18.0,
              fontWeight: FontWeight.bold,
            ),
          ),
        ),
      ),
    );
  }
}