import 'dart:convert';

import 'package:flutter/material.dart';

import '../models/article.dart';
import '../models/categorie.dart';
import '../providers/api_provider.dart';
import 'article_filter_page.dart';
import 'article_page.dart';
import 'categorie_page.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  List<Article> articles = [];
  List<Categorie> categories = [];
  List<Article> filteredArticles = [];
  TextEditingController searchKeywordController = TextEditingController();
  bool isDescendingOrder = true;
  String searchKeyword = ''; 

  @override
  void initState() {
    super.initState();
    fetchData();
  }

  void fetchData() async {
    await fetchArticles();
    await fetchCategories();
  }

  Future<void> fetchArticles() async {
    final order = isDescendingOrder ? 'date-desc' : 'date-asc';
    final response = await ApiProvider.get('/api/articles?sort=$order');
    if (response.statusCode == 200) {
      final Map<String, dynamic> data = json.decode(response.body);
      final List<dynamic> articlesJson = data['articles'];
      setState(() {
        articles = articlesJson.map((json) => Article.fromJson(json)).toList();
        filteredArticles = articles;
      });
    } else {
      throw Exception('Failed to fetch articles');
    }
  }

  Future<void> fetchCategories() async {
    final response = await ApiProvider.get('/api/categories');

    if (response.statusCode == 200) {
      final Map<String, dynamic> data = json.decode(response.body);
      final List<dynamic> categoriesJson = data['categories'];

      setState(() {
        categories = categoriesJson
            .map((json) => Categorie.fromJson(json))
            .toList();
      });
    } else {
      throw Exception('Failed to fetch categories');
    }
  }

  void toggleSortOrder() {
    setState(() {
      isDescendingOrder = !isDescendingOrder;
    });
    fetchArticles();
  }

  void filterArticles() {
  setState(() {
    filteredArticles = articles.where((article) {
      final titleMatches = article.titre
          .toLowerCase()
          .contains(searchKeyword.toLowerCase());
      final summaryMatches = article.resume
          .toLowerCase()
          .contains(searchKeyword.toLowerCase());
      return titleMatches || summaryMatches;
    }).toList();
  });
}


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Row(
          children: [
            IconButton(
              icon: Icon(Icons.search),
              onPressed: () {
                showSearch(
                  context: context,
                  delegate: ArticleSearchDelegate(filteredArticles),

                );
              },
              tooltip: 'Rechercher',
            ),
            Expanded(
              child: TextField(
              controller: searchKeywordController,
              onChanged: (value) {
                setState(() {
                  searchKeyword = value;
                });
                filterArticles();
              },
              decoration: InputDecoration(
              hintText: 'Rechercher...',
              border: InputBorder.none,
          ),
        ),
      ),
            Text('MiniPress'),
          ],
        ),
        actions: [
          IconButton(
            icon: Icon(Icons.sort_by_alpha),
            onPressed: toggleSortOrder,
            tooltip: isDescendingOrder
                ? 'Trié par ordre croissant'
                : 'Trié par ordre décroissant',
          ),
        ],
      ),
      body: Column(
        children: [
          Container(
            height: 50,
            child: ListView.builder(
              scrollDirection: Axis.horizontal,
              itemCount: categories.length,
              itemBuilder: (context, index) {
                final categorie = categories[index];
                return Padding(
                  padding: const EdgeInsets.all(8.0),
                  child: GestureDetector(
                    onTap: () {
                      Navigator.push(
                        context,
                        MaterialPageRoute(
                          builder: (context) =>
                              CategoriePage(categorie: categorie),
                        ),
                      );
                    },
                    child: Chip(
                      label: Text(
                        categorie.titre,
                        style: TextStyle(
                          color: Colors.white,
                        ),
                      ),
                      backgroundColor: Colors.blue,
                    ),
                  ),
                );
              },
            ),
          ),
          Expanded(
            child: ListView.builder(
              itemCount: filteredArticles.length,
              itemBuilder: (context, index) {
                final article = filteredArticles[index];
                return ListTile(
                  title: Text(article.titre),
                  subtitle: Text(
                      'Auteur: ${article.auteur} | Créé le: ${article.createdAt.year}-${article.createdAt.month}-${article.createdAt.day}'),
                  onTap: () {
                    Navigator.push(
                      context,
                      MaterialPageRoute(
                        builder: (context) =>
                            ArticlePage(article: article),
                      ),
                    );
                  },
                );
              },
            ),
          ),
        ],
      ),
    );
  }
}