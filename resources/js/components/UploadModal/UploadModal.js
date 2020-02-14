import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import {
  Button, Icon, Modal, message, Row, Input, Upload,
} from 'antd'
import PropTypes from 'prop-types'
import { postPicture } from '../services/index'

const UploadModal = (props) => {
  const [isModalVisible, setIsModalVisible] = useState(false)
  const [caption, setCaption] = useState('')
  const [upload, setUpload] = useState([])
  const handlePost = () => {
    postPicture({ caption, media: upload.originFileObj, author: props.authorId }).then((response) => {
      if (response.data.success) {
        message.success('Post Uploaded')
      }
      setIsModalVisible(false)
    })
  }

  return (
    <Row>
      {isModalVisible && (
        <Modal
          title='post a picture'
          visible={isModalVisible}
          onCancel={() => setIsModalVisible(false)}
          onOk={handlePost}>
          <Upload
            accept='image/*'
            customRequest={() => { }}
            onChange={(value) => setUpload(value.file)}>
            <Button>
              click here to Upload
            </Button>
          </Upload>
          <Input
            value={caption}
            onChange={(value) => setCaption(value.target.value)}
            placeholder='enter a caption here' />
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
