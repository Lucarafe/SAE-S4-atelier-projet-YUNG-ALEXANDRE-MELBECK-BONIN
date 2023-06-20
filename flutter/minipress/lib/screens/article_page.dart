import 'dart:convert';

import 'package:flutter/material.dart';

import '../models/article.dart';
import '../providers/api_provider.dart';

class ArticlePage extends StatefulWidget {
  final Article article;

  ArticlePage({required this.article});

  @override
  _ArticlePageState createState() => _ArticlePageState();
}

class _ArticlePageState extends State<ArticlePage> {
  String? articleContent;
  String? articleresume;

  @override
  void initState() {
    super.initState();
    fetchArticleContent();
  }

  void fetchArticleContent() async {
    final response =
        await ApiProvider.get('/api/articles/${widget.article.id}');

    if (response.statusCode == 200) {
      final Map<String, dynamic> data = json.decode(response.body);
      final String contentArticle = data['article']['contenu'];
      final String resumeArticle = data['article']['resume'];
      setState(() {
        articleContent = contentArticle;
        articleresume = resumeArticle;
      });
    } else {
      throw Exception('Failed to fetch article');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(widget.article.titre),
      ),
      body: Padding(
        padding: const EdgeInsets.all(8.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text('Titre: ${widget.article.titre}'),
            SizedBox(height: 16),
            Text('Auteur: ${widget.article.auteur}'),
            SizedBox(height: 16),
            Text('Créé le: ${widget.article.createdAt.toString()}'),
            SizedBox(height: 16),
            if (articleContent != null)
              Text('resumé : $articleresume'),
            SizedBox(height: 16),
            if (articleContent != null)
              Text('Contenu: $articleContent'),
          ],
        ),
      ),
    );
  }
}
