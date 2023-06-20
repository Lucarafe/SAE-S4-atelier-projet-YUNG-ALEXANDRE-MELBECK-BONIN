class Categorie {
  final String id;
  final String titre;
  final String resume;
  final String href;


  Categorie({
    required this.id,
    required this.titre,
    required this.resume,
    required this.href
  });

  factory Categorie.fromJson(Map<String, dynamic> json) {
  return Categorie(
    id: json['categorie']['id'].toString(),
    titre: json['categorie']['titre'].toString(),
    resume: json['categorie']['resume'].toString(),
    href: json['links']['self']['href'] ?? '',
  );
}

}
