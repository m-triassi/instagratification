import {
  Card, Icon, Row, Col, Input, Typography, message,
} from 'antd'
import React, {useState} from 'react'
import ReactDOM from 'react-dom'
import Comment from '../Comment/Comment'
import '../../../sass/Photo.scss'
import {likePhoto, commentPhoto, getComments} from '../services/index'

const {Meta} = Card
const Photo = (props) => {
  const {isSinglePost} = props
  const {
    media, id, caption, author, comments, likes,
  } = props.post
  if (!id) return
  const [isCommentInputVisible, setIsCommentInputVisible] = useState(false)
  const [isLiked, setIsLiked] = useState(false)
  const [likeCount, setLikedCount] = useState(likes)
  const [comment, setComment] = useState('')
  const [isCommentExpanded, setIsCommentExpanded] = useState(false)
  const [postComments, setPostComments] = useState(comments)

  const getPostInfoText = () => {
    if (postComments && postComments.length > 1) {
      return (
        <Typography.Text
          style={{fontSize: 11, color: '#EABFB9'}}
          onClick={() => {
            setIsCommentExpanded(!isCommentExpanded)
          }}>
            click here to expand the comments
        </Typography.Text>
      )
    } if (isSinglePost) {
      return (
        <Typography.Text style={{fontSize: 11, color: '#EABFB9'}}>this post contains no comments</Typography.Text>
      )
    }
    return (
      <a href={`/post/${id}`}><Typography.Text style={{fontSize: 11, color: '#EABFB9'}}>click here to view the post</Typography.Text></a>
    )
  }

  const description = (
    <Row className='captionRow'>
      <Row>
        <a href={`/user/${author.name}`}>
          <Typography.Text strong>
            {author.name}
            {' '}
          </Typography.Text>
        </a>
        <Typography.Text>{caption}</Typography.Text>
      </Row>
      <Row>
        {getPostInfoText()}
        {isCommentExpanded && postComments.map((value) => (
          <Comment author={value.author} comment={value.comment} />
        ))}
      </Row>
    </Row>
  )

  const image = (<img style={{padding: 20, aspectRatio: 3 / 2}} src={media} />)

  const handleComment = () => commentPhoto({comment, author: props.user.id, postID: id})
    .then((response) => {
      if (response.data.success) {
        message.success('your comment has been added')
        setIsCommentInputVisible(false)
        setComment('')
        getComments(id).then((commentResponse) => {
          if (commentResponse.data.success) {
            setPostComments(commentResponse.data)
          }
        })
      }
    })

  const handleLike = () => {
    likePhoto({postID: id}).then((response) => {
      if (response.data.success) {
        setLikedCount(likeCount + 1)
        setIsLiked(true)
      }
    })
  }

  return (
    <Card
      hoverable
      className='photoCard'
      cover={image}>
      <Row
        gutter={16}
        className='photoActionRow'>
        <Col span={1}>
          <Icon type='heart' theme={(isLiked) ? 'filled' : null} onClick={handleLike} />
        </Col>
        {likeCount > 0
          && <Col span={2}>
            <Typography.Text className='likeCount'>{likeCount}</Typography.Text>
          </Col>}
        <Col span={1}>
          <Icon type='message' onClick={() => setIsCommentInputVisible(!isCommentInputVisible)} />
        </Col>
      </Row>
      <Meta description={description} />
      {isCommentInputVisible
        && <Row className='commentInputRow'>
          <Input
            value={comment}
            placeholder='insert your comment'
            onChange={(value) => setComment(value.target.value)}
            onBlur={() => setIsCommentInputVisible(false)}
            onPressEnter={handleComment} />
          </Row>}
    </Card>
  )
}

Photo.displayName = 'Photo'
export default Photo
const elements = Array.from(document.getElementsByClassName('photo'))
if (elements) {
  const post = []
  elements.map((component) => {
    post.push(<Photo post={JSON.parse(component.getAttribute('post'))} user={JSON.parse(component.getAttribute('user'))} isSinglePost={JSON.parse(component.getAttribute('isSinglePost'))} />)
  })
  ReactDOM.render(post, document.getElementById('photo-container'))
}
