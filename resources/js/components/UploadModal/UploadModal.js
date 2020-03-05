import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import {
  Button, Form, Icon, Modal, message, Row, Input, Upload,
} from 'antd'
import PropTypes from 'prop-types'
import { postPicture } from '../services/index'

const UploadModal = (props) => {
  const [isModalVisible, setIsModalVisible] = useState(false)
  const [caption, setCaption] = useState('')
  const [upload, setUpload] = useState([])
  const handlePost = () => {
    if (!upload || !caption) {
      message.error('post failed')
    }
    postPicture({ caption, media: upload, author: props.authorId })
      .then((response) => {
        if (response.data.success) {
          message.success('post uploaded')
        } else message.error('post failed')
        setIsModalVisible(false)
      })
  }

  const dummyRequest = ({ onSuccess }) => {
    setTimeout(() => {
      onSuccess('ok')
    }, 0)
  }
  return (
    <Row>
      {isModalVisible && (
        <Modal
          title='post a picture'
          visible={isModalVisible}
          onCancel={() => setIsModalVisible(false)}
          onOk={handlePost}>
          <Form.Item label='Upload' required>
            <Upload
              accept='image/*'
              customRequest={dummyRequest}
              onChange={(value) => {
                const reader = new FileReader()
                reader.onloadend = () => {
                  setUpload(reader.result)
                }
                reader.readAsDataURL(value.file.originFileObj)
              }}>
              <Button icon='upload'>
              click here to Upload
              </Button>
            </Upload>
          </Form.Item>
          <Form.Item label='Caption' required>
            <Input
              value={caption}
              onChange={(value) => setCaption(value.target.value)}
              placeholder='enter a caption here' />
          </Form.Item>
        </Modal>)}
      <Icon type='plus' onClick={() => setIsModalVisible(true)} />
    </Row>
  )
}

UploadModal.prototype = {
  authorId: PropTypes.number,
}

UploadModal.displayName = 'UploadModal'
export default UploadModal

if (document.getElementById('upload-modal')) {
  const component = document.getElementById('upload-modal')
  ReactDOM.render(<UploadModal authorId={JSON.parse(component.getAttribute('authorId'))} />, component)
}
