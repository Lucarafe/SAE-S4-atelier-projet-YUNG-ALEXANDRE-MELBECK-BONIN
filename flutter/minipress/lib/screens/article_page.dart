import 'package:flutter/material.dart';

import '../models/article.dart';

class ArticlePage extends StatelessWidget {
  final Article article;

  ArticlePage({required this.article});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(article.titre),
      ),
      body: Padding(
        padding: const EdgeInsets.all(8.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Auteur: ${article.auteur}'),
            SizedBox(height: 16),
            Text('Créé le: ${article.createdAt.toString()}'),
            SizedBox(height: 16),
          ],
        ),
      ),
    );
  }
}
