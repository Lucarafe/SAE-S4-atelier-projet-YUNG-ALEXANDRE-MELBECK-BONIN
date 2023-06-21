import 'dart:convert';

import 'package:flutter/material.dart';

import '../models/article.dart';
import '../providers/api_provider.dart';
import 'auteur_articles_page.dart';

class ArticlePage extends StatefulWidget {
  Article article;

  ArticlePage({required this.article});

  @override
  _ArticlePageState createState() => _ArticlePageState();
}

class _ArticlePageState extends State<ArticlePage> {
  String? articleContent;
  String? articleResume;
  Article? fetchedArticle;

  @override
  void initState() {
    super.initState();
    fetchArticleContent();
  }

  void fetchArticleContent() async {
    final response = await ApiProvider.get(widget.article.href);

    if (response.statusCode == 200) {
      final Map<String, dynamic> data = json.decode(response.body);

      final String contenuArticle = data['article']['contenu'];
      final String resumeArticle = data['article']['resume'];
      final String id = data['article']['id'].toString();
      final String titre = data['article']['titre'];
      final String auteur = data['article']['auteur'];
      final DateTime createdAt =
          DateTime.parse(data['article']['created_at']);
      final String hrefAuteur =
          data['links']['articles_author']['href'];

      fetchedArticle = Article(
        id: id,
        titre: titre,
        resume: resumeArticle,
        contenu: contenuArticle,
        auteur: auteur,
        createdAt: createdAt,
        href: widget.article.href,
        hrefAuteur: hrefAuteur,
      );
      setState(() {});
    } else {
      throw Exception('Failed to fetch article');
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(fetchedArticle?.titre ?? widget.article.titre),
      ),
      body: SingleChildScrollView(
        child: Padding(
          padding: const EdgeInsets.all(8.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                  'Titre: ${fetchedArticle?.titre ?? widget.article.titre}'),
              const SizedBox(height: 16),
              Text(
                  'contenu : ${fetchedArticle?.contenu ?? widget.article.contenu}'),
              const SizedBox(height: 16),
              GestureDetector(
                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (context) => AuthorArticlesPage(
                        article: fetchedArticle ?? widget.article,
                      ),
                    ),
                  );
                },
                child: Text(
                  'Auteur: ${fetchedArticle?.auteur ?? widget.article.auteur}',
                  style: const TextStyle(
                    color: Colors.blue,
                    decoration: TextDecoration.underline,
                  ),
                ),
              ),
              const SizedBox(height: 16),
              Text(
                  'Créé le: ${fetchedArticle?.createdAt.toString() ?? widget.article.createdAt.toString()}'),
            ],
          ),
        ),
      ),
    );
  }
}
