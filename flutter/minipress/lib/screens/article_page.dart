import 'dart:convert';

import 'package:flutter/material.dart';

import '../models/article.dart';
import '../providers/api_provider.dart';
import 'auteur_articles_page.dart';

class ArticlePage extends StatefulWidget {
  late final Article article;

  ArticlePage({required this.article});

  @override
  _ArticlePageState createState() => _ArticlePageState();
}

class _ArticlePageState extends State<ArticlePage> {
  String? articleContent;
  String? articleResume;

  @override
  void initState() {
    super.initState();
    fetchArticleContent();
  }

  void fetchArticleContent() async {
    final response = await ApiProvider.get(widget.article.href);

    if (response.statusCode == 200) {
      final Map<String, dynamic> data = json.decode(response.body);
      final String contentArticle = data['article']['contenu'];
      final String resumeArticle = data['article']['resume'];
      final String id = data['article']['id'].toString();
      final String titre = data['article']['titre'].toString();
      final String auteur = data['article']['auteur'].toString();
      final DateTime createdAt = DateTime.parse(data['created_at']);
      final Article fetchedArticle = Article(
        id: id,
        titre: titre,
        resume: resumeArticle,
        contenu: contentArticle,
        auteur: auteur,
        createdAt: createdAt,
        href: widget.article.href,
      );

      setState(() {
        articleContent = contentArticle;
        articleResume = resumeArticle;
        widget.article = fetchedArticle;
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
            Text('Résumé: ${widget.article.resume}'),
            SizedBox(height: 16),
            Text('Contenu: ${widget.article.contenu}'),
            SizedBox(height: 16),
            GestureDetector(
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(
                    builder: (context) => AuthorArticlesPage(
                      author: widget.article.auteur, articles: const [],
                    ),
                  ),
                );
              },
              child: Text(
                'Auteur: ${widget.article.auteur}',
                style: TextStyle(
                  color: Colors.blue,
                  decoration: TextDecoration.underline,
                ),
              ),
            ),
            SizedBox(height: 16),
            Text('Créé le: ${widget.article.createdAt.toString()}'),
          ],
        ),
      ),
    );
  }
}
