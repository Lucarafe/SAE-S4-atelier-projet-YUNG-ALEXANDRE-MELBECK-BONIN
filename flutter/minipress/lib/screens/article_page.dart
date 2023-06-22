import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_markdown/flutter_markdown.dart';
import '../models/article.dart';
import '../providers/api_provider.dart';
import 'auteur_articles_page.dart';

class ArticlePage extends StatefulWidget {
  final Article article;

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
      final DateTime createdAt = DateTime.parse(data['article']['created_at']);
      final String hrefAuteur = data['links']['articles_author']['href'];
      final String image = data['article']['img'];
      fetchedArticle = Article(
        id: id,
        titre: titre,
        resume: resumeArticle,
        contenu: contenuArticle,
        auteur: auteur,
        createdAt: createdAt,
        href: widget.article.href,
        hrefAuteur: hrefAuteur,
        image: image,
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
        backgroundColor: Colors.grey[800],
      ),
      body: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Expanded(
            child: Padding(
              padding: const EdgeInsets.all(8.0),
              child: SingleChildScrollView(
                child: Column(
                  children: [
                    const SizedBox(height: 16),
                    Center(
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          const SizedBox(height: 16),
                          if ((fetchedArticle?.image != "") ||
                              (widget.article.image != ""))
                            Image.asset(
                                fetchedArticle?.image ?? widget.article.image),
                        ],
                      ),
                    ),
                    const SizedBox(height: 16),
                    MarkdownBody(
                      data: fetchedArticle?.contenu ?? widget.article.contenu,
                    ),
                    const SizedBox(height: 16),
                    Text(
                      'Auteur: ${fetchedArticle?.auteur ?? widget.article.auteur}',
                    ),
                    const SizedBox(height: 16),
                    Text(
                      'Créé le: ${fetchedArticle?.createdAt.toString() ?? widget.article.createdAt.toString()}',
                    ),
                  ],
                ),
              ),
            ),
          ),
          Container(
            width: double.infinity,
            decoration: BoxDecoration(
              color: Colors.grey[200],
              borderRadius: BorderRadius.circular(8),
            ),
            padding: EdgeInsets.all(16),
            child: GestureDetector(
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
              child: Center(
                child: Text(
                  'Voir tous les articles de cet auteur',
                  style: TextStyle(
                    fontSize: 16,
                    fontWeight: FontWeight.bold,
                    color: Colors.grey[800],
                    decoration: TextDecoration.underline,
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}
