$(function(){
$('#upper_content').masonry({ //親要素のクラスを指定
  itemSelector: '.box', //整理される要素のclassを指定
  columnWidth: 30, //一列の幅サイズを指定
  isAnimated: true, //スムースアニメーション設定
  isFitWidth: false, //親要素の幅サイズがピッタリ
  containerStyle: { position: 'relative' } //親要素にスタイルを追加できる
});
$('#friends_all').masonry({ //親要素のクラスを指定
  itemSelector: '.fbox', //整理される要素のclassを指定
  columnWidth: 10, //一列の幅サイズを指定
  isAnimated: true, //スムースアニメーション設定
  isFitWidth: true, //親要素の幅サイズがピッタリ
  containerStyle: { position: 'relative'} //親要素にスタイルを追加できる
});
});