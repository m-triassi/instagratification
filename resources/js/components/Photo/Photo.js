import {
  Card, Icon, Row, Col, Input, Typography, message,
} from 'antd'
import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import { likePhoto, commentPhoto } from '../services/index'

const { Meta } = Card
const Photo = (props) => {
  const {
    media, id, caption, author, comments, likes,
  } = props.post
  if (!id) return
  const [isCommentInputVisible, setIsCommentInputVisible] = useState(false)
  const [isLiked, setIsLiked] = useState(false)
  const [likeCount, setLikedCount] = useState(likes)
  const [comment, setComment] = useState('')
  const [isCommentExpanded, setIsCommentExpanded] = useState(false)

  const description = (
    <Row style={{ fontSize: 12 }}>
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
        {(comments && comments.length > 1)
          ? <Typography.Text
            style={{ fontSize: 11, color: '#EABFB9' }}
            onClick={() => {
              setIsCommentExpanded(!isCommentExpanded)
            }}>
            click here to expand the comments
          </Typography.Text>
          : <a href={`post/${id}`}><Typography.Text style={{ fontSize: 11, color: '#EABFB9' }}>click here to view the post</Typography.Text></a>}
        {isCommentExpanded && comments.map((value) => (
          <Row style={{ fontSize: 9 }}>
            <a href={`/user/${value.author.name}`}>
              <Typography.Text strong>
                {value.author.name}
                {' '}
              </Typography.Text>
            </a>
            <Typography.Text>{value.comment}</Typography.Text>
          </Row>
        ))}
      </Row>
    </Row>
  )

  const handleComment = () => commentPhoto({ comment, author: props.user.id, postID: id })
    .then((response) => {
      if (response.data.success) {
        message.success('your comment has been added')
        setIsCommentInputVisible(false)
        setComment('')
      }
    })

  const handleLike = () => {
    likePhoto({ postID: id }).then((response) => {
      if (response.data.success) {
        setLikedCount(likeCount + 1)
        setIsLiked(true)
      }
    })
  }

  return (
    <Card
      hoverable
      style={{
        backgroundColor: '#F5F5F5', width: 512, marginBottom: 15, marginLeft: 'auto', marginRight: 'auto',
      }}
      cover={<img style={{ padding: 20, aspectRatio: 3 / 2 }} src={media} />}>
      <Row
        gutter={16}
        style={{ marginTop: -40, paddingBottom: 10 }}>
        <Col span={1}>
          <Icon type='heart' theme={(isLiked) ? 'filled' : null} onClick={handleLike} />
        </Col>
        {likeCount > 0
          && <Col span={2}>
            <Typography.Text style={{ fontSize: 10 }}>{likeCount}</Typography.Text>
          </Col>}
        <Col span={1}>
          <Icon type='message' onClick={() => setIsCommentInputVisible(!isCommentInputVisible)} />
        </Col>
      </Row>
      <Meta description={description} />
      {isCommentInputVisible
        && <Row style={{ marginTop: 10 }}>
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
    post.push(<Photo post={JSON.parse(component.getAttribute('post'))} user={JSON.parse(component.getAttribute('user'))} />)
  })
  ReactDOM.render(post, document.getElementById('photo-container'))
}
